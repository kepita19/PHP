<?php

function conexionMemoria(): PDO
{
    $directorioBase = getenv("LOCALAPPDATA") ?: getenv("XDG_DATA_HOME");
    if (!$directorioBase) {
        $directorioBase = getenv("HOME")
            ? getenv("HOME") . DIRECTORY_SEPARATOR . ".local" . DIRECTORY_SEPARATOR . "share"
            : sys_get_temp_dir();
    }

    $directorio = rtrim($directorioBase, "\\/") . DIRECTORY_SEPARATOR . "Nora";
    if (!is_dir($directorio) && !mkdir($directorio, 0700, true) && !is_dir($directorio)) {
        throw new RuntimeException("No se pudo crear el directorio local de memoria.");
    }

    $conexion = new PDO("sqlite:" . $directorio . DIRECTORY_SEPARATOR . "memoria.sqlite");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("PRAGMA busy_timeout = 5000");
    $conexion->exec(
        "CREATE TABLE IF NOT EXISTS mensajes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            rol TEXT NOT NULL CHECK (rol IN ('user', 'assistant')),
            contenido TEXT NOT NULL,
            creado_en TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
        )"
    );

    return $conexion;
}

function guardarMensaje(PDO $conexion, string $rol, string $contenido): void
{
    $consulta = $conexion->prepare("INSERT INTO mensajes (rol, contenido) VALUES (:rol, :contenido)");
    $consulta->execute(["rol" => $rol, "contenido" => $contenido]);
    $conexion->exec(
        "DELETE FROM mensajes WHERE id NOT IN (
            SELECT id FROM mensajes ORDER BY id DESC LIMIT 300
        )"
    );
}

function obtenerMensajes(PDO $conexion, int $limite): array
{
    $consulta = $conexion->prepare(
        "SELECT rol, contenido, creado_en FROM mensajes ORDER BY id DESC LIMIT :limite"
    );
    $consulta->bindValue(":limite", $limite, PDO::PARAM_INT);
    $consulta->execute();

    return array_reverse($consulta->fetchAll(PDO::FETCH_ASSOC));
}

function limpiarMemoria(PDO $conexion): void
{
    $conexion->exec("DELETE FROM mensajes");
}