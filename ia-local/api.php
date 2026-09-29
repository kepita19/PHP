<?php
require_once __DIR__ . "/memoria.php";

header("Content-Type: application/json; charset=UTF-8");

function responderJson(array $datos, int $codigo = 200): void
{
    http_response_code($codigo);
    echo json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
}

function emitirEvento(array $evento): void
{
    echo json_encode($evento, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE) . "\n";
    flush();
}

function prepararRespuestaEnFlujo(): void
{
    header("Content-Type: application/x-ndjson; charset=UTF-8");
    header("Cache-Control: no-cache, no-transform");
    header("X-Accel-Buffering: no");
    @ini_set("output_buffering", "off");
    @ini_set("zlib.output_compression", "0");
    while (ob_get_level() > 0) {
        ob_end_flush();
    }
}

$metodo = $_SERVER["REQUEST_METHOD"] ?? "GET";
if ($metodo !== "GET" && $metodo !== "POST") {
    responderJson(["error" => "Método no permitido"], 405);
    exit;
}

try {
    $conexion = conexionMemoria();
} catch (Throwable $error) {
    responderJson(["error" => "No se pudo abrir la memoria local de Nora.", "detalle" => $error->getMessage()], 500);
    exit;
}

if ($metodo === "GET") {
    responderJson(["mensajes" => obtenerMensajes($conexion, 100)]);
    exit;
}

$datos = json_decode(file_get_contents("php://input"), true);
if (!is_array($datos)) {
    responderJson(["error" => "La petición no contiene JSON válido."], 400);
    exit;
}

if (($datos["accion"] ?? "") === "limpiar") {
    limpiarMemoria($conexion);
    responderJson(["ok" => true]);
    exit;
}

$pregunta = trim($datos["pregunta"] ?? "");
$modo = ($datos["modo"] ?? "chat") === "codigo" ? "codigo" : "chat";
$buscarWeb = $modo === "chat" && ($datos["buscar_web"] ?? false) === true;
set_time_limit($modo === "codigo" ? 900 : 120);
$lenguajes = [
    "web" => "HTML, CSS y JavaScript",
    "html" => "HTML",
    "css" => "CSS",
    "javascript" => "JavaScript",
    "php" => "PHP",
    "python" => "Python",
    "sql" => "SQL",
    "java" => "Java",
    "csharp" => "C#",
    "bash" => "Bash"
];
$lenguaje = $lenguajes[$datos["lenguaje"] ?? "web"] ?? "HTML, CSS y JavaScript";

if ($pregunta === "") {
    responderJson(["error" => "Escribe una pregunta"], 400);
    exit;
}

function respuestaConversacion(string $pregunta): ?string
{
    $texto = mb_strtolower(trim($pregunta), "UTF-8");

    if (preg_match("/^(hola|holaa|hola hola|buenas|buenos dias|buenas tardes|buenas noches|hey|que tal)[!.? ]*$/u", $texto)) {
        return "¡Hola! ¿En qué puedo ayudarte?";
    }
    if (preg_match("/^(adios|adiós|hasta luego|hasta pronto|nos vemos|me voy|chao|ciao)[!.? ]*$/u", $texto)) {
        return "¡Hasta luego! Cuando quieras, aquí estaré.";
    }
    if (preg_match("/^(gracias|muchas gracias|te lo agradezco)[!.? ]*$/u", $texto)) {
        return "¡De nada! Me alegra poder ayudarte.";
    }
    if (preg_match("/^(quien eres|quién eres|que puedes hacer|qué puedes hacer)[!.? ]*$/u", $texto)) {
        return "Soy un asistente local. Puedo conversar contigo y ayudarte a buscar información.";
    }
    return null;
}

function buscarWeb(string $pregunta): array
{
    $url = "https://html.duckduckgo.com/html/?q=" . urlencode($pregunta);
    $contexto = stream_context_create([
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: AsistenteLocal/1.0\r\n",
            "timeout" => 8
        ]
    ]);
    $html = @file_get_contents($url, false, $contexto);
    if ($html === false) return [];

    libxml_use_internal_errors(true);
    $documento = new DOMDocument();
    $documento->loadHTML($html);
    $xpath = new DOMXPath($documento);
    $resultados = [];

    foreach ($xpath->query("//div[contains(@class, 'result')]") as $resultado) {
        $titulo = trim($xpath->evaluate("string(.//a[contains(@class, 'result__a')])", $resultado));
        $resumen = trim($xpath->evaluate("string(.//a[contains(@class, 'result__snippet')])", $resultado));
        if ($titulo !== "" && $resumen !== "") {
            $resultados[] = $titulo . ": " . $resumen;
        }
        if (count($resultados) >= 5) break;
    }
    return $resultados;
}

guardarMensaje($conexion, "user", $pregunta);
$respuestaRapida = $modo === "chat" ? respuestaConversacion($pregunta) : null;
if ($respuestaRapida !== null) {
    guardarMensaje($conexion, "assistant", $respuestaRapida);
    prepararRespuestaEnFlujo();
    emitirEvento(["token" => $respuestaRapida]);
    emitirEvento(["done" => true, "fuentes" => [], "incompleta" => false]);
    exit;
}

$fuentes = $buscarWeb ? buscarWeb($pregunta) : [];
$instrucciones = $modo === "codigo"
    ? "Responde en el mismo idioma que el usuario. Actúa como un desarrollador experto en {$lenguaje}. Entrega una solución completa, correcta, segura y lista para usar; sigue todos los requisitos y cantidades indicados. Mantén la explicación breve y céntrate en el código necesario. No inventes parámetros, funciones, bases de datos ni servicios externos, y no afirmes que has ejecutado o probado el código."
    : "Responde en español, de forma clara, breve y honesta. Usa los resultados web como apoyo, pero indica si la información no es suficiente. No inventes fuentes ni datos.";
$mensajes = [["role" => "system", "content" => $instrucciones]];
$historial = obtenerMensajes($conexion, $modo === "codigo" ? 4 : 12);
foreach ($historial as $mensaje) {
    $mensajes[] = ["role" => $mensaje["rol"], "content" => $mensaje["contenido"]];
}

if ($buscarWeb && $fuentes && count($mensajes) > 1) {
    $indiceUltimo = count($mensajes) - 1;
    $mensajes[$indiceUltimo]["content"] .= "\n\nResultados web recientes:\n" . implode("\n", $fuentes);
}

prepararRespuestaEnFlujo();
$contenidoCompleto = "";
$errorOllama = null;
$incompleta = false;
$maxContinuaciones = 2;
$continuacion = 0;
$maxTokens = $modo === "codigo" ? 1400 : 350;

while (true) {
    $peticion = json_encode([
        "model" => "llama3.2",
        "stream" => true,
        "keep_alive" => "10m",
        "options" => ["temperature" => $modo === "codigo" ? 0.2 : 0.4, "num_predict" => $maxTokens],
        "messages" => $mensajes
    ], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);

    $opciones = [
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n",
            "content" => $peticion,
            "timeout" => $modo === "codigo" ? 300 : 120,
            "ignore_errors" => true
        ]
    ];
    $flujo = @fopen("http://127.0.0.1:11434/api/chat", "rb", false, stream_context_create($opciones));
    if ($flujo === false) {
        $errorOllama = $contenidoCompleto === ""
            ? "Ollama no está disponible. Ábrelo e instala el modelo con: ollama pull llama3.2"
            : "No se pudo completar la continuación de Ollama.";
        break;
    }

    $estadoHttp = $http_response_header[0] ?? "";
    if (preg_match("/\s([45]\d{2})\s/", $estadoHttp, $coincidenciaEstado)) {
        $cuerpoError = json_decode(stream_get_contents($flujo), true);
        fclose($flujo);
        $errorOllama = $cuerpoError["error"] ?? "Ollama respondió con HTTP " . $coincidenciaEstado[1];
        break;
    }

    $contenidoSegmento = "";
    $motivoFin = "";
    while (!feof($flujo)) {
        $linea = fgets($flujo);
        if ($linea === false) {
            $estadoFlujo = stream_get_meta_data($flujo);
            if ($estadoFlujo["timed_out"] ?? false) {
                $errorOllama = "Ollama tardó demasiado en responder.";
            }
            break;
        }

        $fragmento = json_decode(trim($linea), true);
        if (!is_array($fragmento)) continue;
        if (isset($fragmento["error"])) {
            $errorOllama = $fragmento["error"];
            break;
        }

        $token = $fragmento["message"]["content"] ?? "";
        if ($token !== "") {
            $contenidoSegmento .= $token;
            $contenidoCompleto .= $token;
            emitirEvento(["token" => $token]);
        }

        if (($fragmento["done"] ?? false) === true) {
            $motivoFin = $fragmento["done_reason"] ?? "";
            break;
        }
    }
    fclose($flujo);

    if ($errorOllama !== null || $motivoFin !== "length") break;
    if ($continuacion >= $maxContinuaciones || $contenidoSegmento === "") {
        $incompleta = true;
        break;
    }

    $mensajes[] = ["role" => "assistant", "content" => $contenidoSegmento];
    $mensajes[] = [
        "role" => "user",
        "content" => "Continúa exactamente desde donde terminó tu respuesta anterior. No repitas nada ni añadas una introducción; completa lo que falta y cierra correctamente el código o la explicación. Mantén el mismo idioma."
    ];
    $continuacion++;
}

if ($contenidoCompleto === "") {
    emitirEvento(["error" => $errorOllama ?? "Ollama no devolvió ninguna respuesta."]);
    exit;
}

guardarMensaje($conexion, "assistant", $contenidoCompleto);
emitirEvento([
    "done" => true,
    "fuentes" => $fuentes,
    "incompleta" => $incompleta || $errorOllama !== null
]);
