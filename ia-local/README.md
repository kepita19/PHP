# Nora: asistente local

Aplicación PHP que usa Ollama en local, sin API keys. Permite conversar con el asistente o generar código con instrucciones específicas para cada lenguaje.

## Funciones

- Conversación en español con búsqueda web opcional como contexto.
- Historial persistente en SQLite local; Nora reutiliza los últimos 12 mensajes como contexto y conserva hasta 300.
- Respuestas de Ollama en streaming, visibles mientras se generan.
- Generación de código para HTML, CSS, JavaScript, PHP, Python, SQL, Java, C# y Bash; también puede preparar un proyecto web con HTML, CSS y JavaScript.
- Bloques de código separados y botón para copiar cada bloque.
- Ejemplos iniciales para crear una página web, un formulario PHP o un script Python.

## Preparación

1. Instala Ollama.
2. Comprueba que PHP tenga habilitadas las extensiones `pdo_sqlite`, `dom` y `mbstring`.
3. En PowerShell ejecuta:

```powershell
ollama pull llama3.2
```

4. Arranca el servidor PHP desde la carpeta que contiene `PHPAriketak`:

```powershell
C:\xampp\php\php.exe -S localhost:8080
```

5. Abre `http://localhost:8080/PHPAriketak/ia-local/`. Si arrancas el servidor desde dentro de `PHPAriketak`, abre `http://localhost:8080/ia-local/`.

La memoria se guarda fuera de la carpeta pública, en `%LOCALAPPDATA%\Nora\memoria.sqlite` en Windows. El botón «Limpiar conversación» borra ese historial. Los mensajes se procesan con Ollama en local; la búsqueda web está desactivada por defecto y, al activarla, la consulta se envía a DuckDuckGo, que puede tener límites si recibe demasiadas peticiones seguidas.
