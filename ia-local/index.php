<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f3f5f1">
    <title>Nora | Asistente local</title>
    <style>
        :root {
            color-scheme: light;
            --canvas: #f3f5f1;
            --surface: #ffffff;
            --surface-soft: #f8f9f6;
            --ink: #202822;
            --muted: #707b72;
            --line: #dce2da;
            --accent: #d9543b;
            --accent-hover: #bb402b;
            --green: #367455;
            --code: #202722;
            --shadow: 0 14px 38px rgba(34, 47, 37, .07);
        }
        * { box-sizing: border-box; }
        body {
            background: var(--canvas);
            color: var(--ink);
            font-family: "Aptos", "Segoe UI", sans-serif;
            margin: 0;
            min-height: 100vh;
        }
        button, textarea, select { font: inherit; }
        button { color: inherit; }
        .shell { margin: 0 auto; max-width: 1180px; min-height: 100vh; padding: 0 32px 28px; }
        .topbar {
            align-items: center;
            border-bottom: 1px solid var(--line);
            display: flex;
            height: 70px;
            justify-content: space-between;
        }
        .brand { align-items: center; display: flex; gap: 11px; }
        .brand-mark {
            align-items: center;
            background: var(--ink);
            border-radius: 8px;
            color: #fff;
            display: inline-flex;
            font-size: 16px;
            font-weight: 800;
            height: 34px;
            justify-content: center;
            width: 34px;
        }
        .brand-name { font-size: 15px; font-weight: 750; letter-spacing: .02em; }
        .brand-caption { color: var(--muted); font-size: 12px; margin-left: 2px; }
        .local-status { align-items: center; color: var(--muted); display: flex; font-size: 12px; gap: 8px; }
        .status-dot { background: #70a67b; border-radius: 50%; height: 8px; width: 8px; }
        main { display: flex; flex-direction: column; margin: 34px auto 0; max-width: 920px; min-height: calc(100vh - 132px); }
        .heading-row { align-items: flex-end; display: flex; justify-content: space-between; margin-bottom: 21px; }
        h1 { font-size: 30px; letter-spacing: 0; line-height: 1.12; margin: 0 0 7px; }
        .intro { color: var(--muted); font-size: 14px; margin: 0; }
        .toolbar { align-items: center; background: #e8ece6; border-radius: 8px; display: flex; gap: 3px; padding: 4px; }
        .mode-button {
            background: transparent;
            border: 0;
            border-radius: 6px;
            color: #536056;
            cursor: pointer;
            font-size: 13px;
            font-weight: 650;
            min-height: 36px;
            padding: 0 13px;
        }
        .mode-button[aria-pressed="true"] { background: var(--surface); box-shadow: 0 1px 3px rgba(25, 37, 28, .12); color: var(--ink); }
        .workbench {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 10px;
            box-shadow: var(--shadow);
            display: flex;
            flex: 1;
            flex-direction: column;
            min-height: 480px;
            overflow: hidden;
        }
        .workbench-bar {
            align-items: center;
            border-bottom: 1px solid var(--line);
            display: flex;
            gap: 12px;
            justify-content: space-between;
            min-height: 55px;
            padding: 0 18px;
        }
        .workspace-name { align-items: center; display: flex; font-size: 13px; font-weight: 700; gap: 9px; }
        .workspace-icon { color: var(--accent); font-family: Consolas, monospace; font-size: 15px; font-weight: 800; }
        .bar-actions { align-items: center; display: flex; flex-wrap: wrap; gap: 12px; }
        .web-search-control { align-items: center; color: var(--muted); cursor: pointer; display: flex; font-size: 12px; gap: 6px; }
        .web-search-control[hidden] { display: none; }
        .web-search-control input { accent-color: var(--accent); margin: 0; }
        .language-control { align-items: center; display: flex; gap: 8px; }
        .language-control[hidden] { display: none; }
        .language-control label { color: var(--muted); font-size: 12px; }
        select {
            appearance: auto;
            background: var(--surface-soft);
            border: 1px solid var(--line);
            border-radius: 6px;
            color: var(--ink);
            cursor: pointer;
            font-size: 12px;
            min-height: 34px;
            padding: 0 9px;
        }
        .clear-button { background: transparent; border: 0; color: var(--muted); cursor: pointer; font-size: 12px; padding: 8px 0; }
        .clear-button:hover { color: var(--accent-hover); }
        #conversacion { flex: 1; overflow-y: auto; padding: 24px clamp(16px, 5vw, 54px); }
        .welcome { margin: 35px auto 0; max-width: 560px; text-align: center; }
        .welcome-mark {
            align-items: center;
            background: #f8e5df;
            border-radius: 12px;
            color: var(--accent-hover);
            display: inline-flex;
            font-family: Consolas, monospace;
            font-size: 19px;
            font-weight: 700;
            height: 48px;
            justify-content: center;
            margin-bottom: 17px;
            width: 48px;
        }
        .welcome h2 { font-size: 22px; letter-spacing: 0; margin: 0 0 8px; }
        .welcome p { color: var(--muted); font-size: 14px; line-height: 1.55; margin: 0 auto; max-width: 430px; }
        .suggestions { display: grid; gap: 9px; grid-template-columns: repeat(3, minmax(0, 1fr)); margin-top: 25px; text-align: left; }
        .suggestion {
            background: var(--surface-soft);
            border: 1px solid var(--line);
            border-radius: 7px;
            cursor: pointer;
            font-size: 12px;
            line-height: 1.45;
            min-height: 68px;
            padding: 12px;
            text-align: left;
            transition: border-color .16s ease, transform .16s ease;
        }
        .suggestion:hover { border-color: #d88b7b; transform: translateY(-2px); }
        .message { line-height: 1.65; margin: 0 0 20px; max-width: 100%; overflow-wrap: anywhere; }
        .message-label { color: var(--muted); font-size: 11px; font-weight: 750; letter-spacing: .04em; margin: 0 0 6px; text-transform: uppercase; }
        .message.user { margin-left: auto; max-width: min(82%, 620px); }
        .message.user .message-body { background: #eef1ed; border-radius: 8px; padding: 12px 15px; white-space: pre-wrap; }
        .message.assistant { max-width: 100%; }
        .message.assistant .message-body { font-size: 14px; }
        .message.assistant .message-body p { margin: 0 0 12px; white-space: pre-wrap; }
        .response-warning { border-left: 3px solid var(--accent); color: var(--accent-hover); padding-left: 10px; }
        .code-block { background: var(--code); border-radius: 8px; margin: 13px 0 16px; overflow: hidden; }
        .code-toolbar { align-items: center; border-bottom: 1px solid #3b463f; color: #c2ccc3; display: flex; font-family: Consolas, monospace; font-size: 11px; justify-content: space-between; min-height: 37px; padding: 0 12px; }
        .copy-button { background: transparent; border: 0; border-radius: 4px; color: #dce4dc; cursor: pointer; font-family: "Aptos", "Segoe UI", sans-serif; font-size: 11px; padding: 5px 7px; }
        .copy-button:hover { background: #354038; }
        .code-block pre { color: #e6eee7; font: 12px/1.65 Consolas, "Courier New", monospace; margin: 0; overflow-x: auto; padding: 15px; tab-size: 4; }
        .composer-area { border-top: 1px solid var(--line); padding: 14px 18px 13px; }
        .composer {
            align-items: flex-end;
            background: var(--surface-soft);
            border: 1px solid #d8ded6;
            border-radius: 8px;
            display: flex;
            gap: 12px;
            padding: 10px 10px 10px 14px;
            transition: border-color .15s ease, box-shadow .15s ease;
        }
        .composer:focus-within { border-color: #ce897a; box-shadow: 0 0 0 3px rgba(217, 84, 59, .09); }
        textarea {
            background: transparent;
            border: 0;
            color: var(--ink);
            flex: 1;
            font-size: 14px;
            line-height: 1.5;
            max-height: 180px;
            min-height: 42px;
            outline: 0;
            padding: 9px 0 5px;
            resize: vertical;
        }
        textarea::placeholder { color: #8a948b; }
        .send-button {
            align-items: center;
            background: var(--accent);
            border: 0;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            display: flex;
            font-size: 13px;
            font-weight: 700;
            gap: 9px;
            justify-content: center;
            min-height: 40px;
            padding: 0 14px;
        }
        .send-button:hover { background: var(--accent-hover); }
        .send-button:disabled { cursor: wait; opacity: .6; }
        .send-arrow { font-size: 18px; line-height: 1; }
        .composer-meta { align-items: center; color: var(--muted); display: flex; font-size: 11px; justify-content: space-between; min-height: 24px; padding: 5px 2px 0; }
        #estado { color: var(--green); }
        .loading { align-items: center; color: var(--muted); display: flex; font-size: 13px; gap: 9px; padding: 8px 0 18px; }
        .loading::before { animation: pulse 1s infinite alternate; background: var(--accent); border-radius: 50%; content: ""; height: 7px; width: 7px; }
        @keyframes pulse { to { opacity: .25; transform: scale(.75); } }
        @media (max-width: 650px) {
            .shell { padding: 0 14px 14px; }
            .topbar { height: 60px; }
            .brand-caption { display: none; }
            main { margin-top: 23px; min-height: calc(100vh - 97px); }
            .heading-row { align-items: flex-start; flex-direction: column; gap: 15px; }
            h1 { font-size: 26px; }
            .toolbar { width: 100%; }
            .mode-button { flex: 1; }
            .workbench { min-height: 520px; }
            .workbench-bar { align-items: flex-start; flex-direction: column; gap: 8px; padding: 12px 14px; }
            .bar-actions { justify-content: space-between; width: 100%; }
            .suggestions { grid-template-columns: 1fr; }
            .suggestion { min-height: 0; }
            .welcome { margin-top: 12px; }
            #conversacion { padding: 22px 15px; }
            .composer-area { padding: 11px; }
            .composer { gap: 8px; padding-left: 11px; }
            .send-button { padding: 0 11px; }
            .send-label { display: none; }
            .message.user { max-width: 92%; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: .01ms !important; scroll-behavior: auto !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <header class="topbar">
            <div class="brand" aria-label="Nora, asistente local">
                <span class="brand-mark" aria-hidden="true">N</span>
                <span class="brand-name">NORA</span>
                <span class="brand-caption">asistente local</span>
            </div>
            <div class="local-status"><span class="status-dot" aria-hidden="true"></span>Procesamiento local con Ollama</div>
        </header>

        <main>
            <div class="heading-row">
                <div>
                    <h1>Tu taller de código.</h1>
                    <p class="intro">Pregunta, explora y convierte una idea en algo que funcione.</p>
                </div>
                <div class="toolbar" role="group" aria-label="Modo de trabajo">
                    <button class="mode-button" type="button" data-mode="chat" aria-pressed="true">Conversar</button>
                    <button class="mode-button" type="button" data-mode="codigo" aria-pressed="false">Generar código</button>
                </div>
            </div>

            <section class="workbench" aria-label="Espacio de trabajo">
                <div class="workbench-bar">
                    <div class="workspace-name"><span class="workspace-icon" aria-hidden="true">&lt;/&gt;</span><span id="workspaceTitle">Conversación</span></div>
                    <div class="bar-actions">
                        <label class="web-search-control" id="webSearchControl">
                            <input id="buscarWeb" type="checkbox">
                            Buscar web
                        </label>
                        <div class="language-control" id="languageControl" hidden>
                            <label for="lenguaje">Lenguaje</label>
                            <select id="lenguaje" name="lenguaje">
                                <option value="web">Web: HTML + CSS + JS</option>
                                <option value="html">HTML</option>
                                <option value="css">CSS</option>
                                <option value="javascript">JavaScript</option>
                                <option value="php">PHP</option>
                                <option value="python">Python</option>
                                <option value="sql">SQL</option>
                                <option value="java">Java</option>
                                <option value="csharp">C#</option>
                                <option value="bash">Bash</option>
                            </select>
                        </div>
                        <button class="clear-button" id="limpiar" type="button" title="Vaciar conversación">Limpiar conversación</button>
                    </div>
                </div>

                <div id="conversacion" aria-live="polite" aria-relevant="additions text">
                    <div class="welcome" id="bienvenida">
                        <span class="welcome-mark" aria-hidden="true">{ }</span>
                        <h2>¿Qué vamos a construir?</h2>
                        <p>Elige un lenguaje, describe lo que necesitas y recibe código listo para adaptar a tu proyecto.</p>
                        <div class="suggestions" aria-label="Ideas para empezar">
                            <button class="suggestion" type="button" data-language="web" data-prompt="Crea una página de portfolio personal moderna y adaptable, con HTML, CSS y JavaScript en archivos separados.">Una página de portfolio con HTML, CSS y JS</button>
                            <button class="suggestion" type="button" data-language="php" data-prompt="Crea un formulario de contacto en PHP con validación básica y muestra errores de forma segura.">Un formulario validado en PHP</button>
                            <button class="suggestion" type="button" data-language="python" data-prompt="Escribe un script de Python que organice archivos por extensión y explique cómo ejecutarlo.">Un script útil en Python</button>
                        </div>
                    </div>
                </div>

                <div class="composer-area">
                    <form id="formulario">
                        <div class="composer">
                            <textarea id="pregunta" name="pregunta" placeholder="Escribe una pregunta o describe el código que necesitas..." rows="1" required></textarea>
                            <button class="send-button" type="submit" aria-label="Enviar mensaje"><span class="send-label">Enviar</span><span class="send-arrow" aria-hidden="true">↑</span></button>
                        </div>
                    </form>
                    <div class="composer-meta"><span id="estado" role="status">Ollama · llama3.2</span><span>Enter para enviar · Mayús + Enter para nueva línea</span></div>
                </div>
            </section>
        </main>
    </div>

    <script>
        const formulario = document.querySelector("#formulario");
        const pregunta = document.querySelector("#pregunta");
        const conversacion = document.querySelector("#conversacion");
        const estado = document.querySelector("#estado");
        const lenguaje = document.querySelector("#lenguaje");
        const languageControl = document.querySelector("#languageControl");
        const webSearchControl = document.querySelector("#webSearchControl");
        const buscarWeb = document.querySelector("#buscarWeb");
        const workspaceTitle = document.querySelector("#workspaceTitle");
        const bienvenida = document.querySelector("#bienvenida");
        const clearButton = document.querySelector("#limpiar");
        const sendButton = formulario.querySelector("button[type='submit']");
        let modo = "chat";

        function seleccionarModo(nuevoModo) {
            modo = nuevoModo;
            document.querySelectorAll(".mode-button").forEach((boton) => {
                boton.setAttribute("aria-pressed", String(boton.dataset.mode === modo));
            });
            languageControl.hidden = modo !== "codigo";
            webSearchControl.hidden = modo !== "chat";
            workspaceTitle.textContent = modo === "codigo" ? "Generación de código" : "Conversación";
            pregunta.placeholder = modo === "codigo"
                ? "Describe qué debe hacer el código, con los detalles que ya tengas..."
                : "Escribe una pregunta o comparte lo que tienes en mente...";
        }

        function agregarTexto(contenedor, texto) {
            const lineas = texto.split("\n");
            lineas.forEach((linea, indice) => {
                if (indice > 0) contenedor.appendChild(document.createElement("br"));
                contenedor.appendChild(document.createTextNode(linea));
            });
        }

        function mostrarRespuesta(texto, incompleta = false) {
            const mensaje = document.createElement("article");
            mensaje.className = "message assistant";
            const etiqueta = document.createElement("div");
            etiqueta.className = "message-label";
            etiqueta.textContent = "Nora";
            const cuerpo = document.createElement("div");
            cuerpo.className = "message-body";
            const bloques = /```([^\n`]*)\n([\s\S]*?)(?:```|$)/g;
            let inicio = 0;
            let coincidencia;

            while ((coincidencia = bloques.exec(texto)) !== null) {
                const antes = texto.slice(inicio, coincidencia.index).trim();
                if (antes) {
                    const parrafo = document.createElement("p");
                    agregarTexto(parrafo, antes);
                    cuerpo.appendChild(parrafo);
                }

                const bloque = document.createElement("div");
                bloque.className = "code-block";
                const barra = document.createElement("div");
                barra.className = "code-toolbar";
                const tipo = document.createElement("span");
                tipo.textContent = coincidencia[1].trim() || "Código";
                const textoCodigo = coincidencia[2];
                const copiar = document.createElement("button");
                copiar.className = "copy-button";
                copiar.type = "button";
                copiar.textContent = "Copiar código";
                copiar.addEventListener("click", async () => {
                    try {
                        await navigator.clipboard.writeText(textoCodigo);
                        copiar.textContent = "Copiado";
                        setTimeout(() => { copiar.textContent = "Copiar código"; }, 1400);
                    } catch {
                        copiar.textContent = "No se pudo copiar";
                    }
                });
                const pre = document.createElement("pre");
                const codigo = document.createElement("code");
                codigo.textContent = textoCodigo;
                pre.appendChild(codigo);
                barra.append(tipo, copiar);
                bloque.append(barra, pre);
                cuerpo.appendChild(bloque);
                inicio = bloques.lastIndex;
            }

            const resto = texto.slice(inicio).trim();
            if (resto) {
                const parrafo = document.createElement("p");
                agregarTexto(parrafo, resto);
                cuerpo.appendChild(parrafo);
            }
            if (incompleta) {
                const aviso = document.createElement("p");
                aviso.className = "response-warning";
                aviso.textContent = "La respuesta alcanzó el límite del modelo y puede estar incompleta. Pídele que continúe o concreta un poco más la tarea.";
                cuerpo.appendChild(aviso);
            }
            mensaje.append(etiqueta, cuerpo);
            conversacion.appendChild(mensaje);
            mensaje.scrollIntoView({ behavior: "smooth", block: "nearest" });
        }

        function mostrarUsuario(texto) {
            const mensaje = document.createElement("article");
            mensaje.className = "message user";
            const etiqueta = document.createElement("div");
            etiqueta.className = "message-label";
            etiqueta.textContent = "Tú";
            const cuerpo = document.createElement("div");
            cuerpo.className = "message-body";
            cuerpo.textContent = texto;
            mensaje.append(etiqueta, cuerpo);
            conversacion.appendChild(mensaje);
            mensaje.scrollIntoView({ behavior: "smooth", block: "nearest" });
        }

        function mostrarRespuestaEnVivo() {
            const mensaje = document.createElement("article");
            mensaje.className = "message assistant";
            mensaje.setAttribute("aria-live", "off");
            const etiqueta = document.createElement("div");
            etiqueta.className = "message-label";
            etiqueta.textContent = "Nora";
            const cuerpo = document.createElement("div");
            cuerpo.className = "message-body";
            const texto = document.createElement("p");
            cuerpo.appendChild(texto);
            mensaje.append(etiqueta, cuerpo);
            conversacion.appendChild(mensaje);
            return { mensaje, texto };
        }

        async function leerFlujo(respuesta, recibirToken) {
            const lector = respuesta.body.getReader();
            const decodificador = new TextDecoder();
            let pendiente = "";
            let metadatos = null;

            function procesarLinea(linea) {
                if (!linea.trim()) return;
                const evento = JSON.parse(linea);
                if (evento.error) throw new Error(evento.error);
                if (typeof evento.token === "string") recibirToken(evento.token);
                if (evento.done) metadatos = evento;
            }

            while (true) {
                const { value, done } = await lector.read();
                pendiente += decodificador.decode(value ?? new Uint8Array(), { stream: !done });
                const lineas = pendiente.split("\n");
                pendiente = lineas.pop();
                lineas.forEach(procesarLinea);
                if (done) break;
            }

            if (pendiente.trim()) procesarLinea(pendiente);
            return metadatos ?? { fuentes: [], incompleta: true };
        }

        async function cargarHistorial() {
            const respuesta = await fetch("api.php");
            const datos = await respuesta.json();
            if (!respuesta.ok) throw new Error(datos.error || "No se pudo cargar la memoria local.");

            if (datos.mensajes.length) {
                bienvenida.hidden = true;
                datos.mensajes.forEach((mensaje) => {
                    if (mensaje.rol === "user") mostrarUsuario(mensaje.contenido);
                    else mostrarRespuesta(mensaje.contenido);
                });
                estado.textContent = "Memoria local · conversación restaurada";
            } else {
                estado.textContent = "Memoria local · lista";
            }
        }

        document.querySelectorAll(".mode-button").forEach((boton) => {
            boton.addEventListener("click", () => seleccionarModo(boton.dataset.mode));
        });

        document.querySelectorAll(".suggestion").forEach((boton) => {
            boton.addEventListener("click", () => {
                seleccionarModo("codigo");
                lenguaje.value = boton.dataset.language;
                pregunta.value = boton.dataset.prompt;
                pregunta.focus();
            });
        });

        clearButton.addEventListener("click", async () => {
            clearButton.disabled = true;
            try {
                const respuesta = await fetch("api.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ accion: "limpiar" })
                });
                const datos = await respuesta.json();
                if (!respuesta.ok) throw new Error(datos.error || "No se pudo borrar la memoria local.");
                conversacion.querySelectorAll(".message, .loading").forEach((mensaje) => mensaje.remove());
                bienvenida.hidden = false;
                estado.textContent = "Memoria local borrada";
                pregunta.focus();
            } catch (error) {
                estado.textContent = error.message;
            } finally {
                clearButton.disabled = false;
            }
        });

        pregunta.addEventListener("keydown", (evento) => {
            if (evento.key === "Enter" && !evento.shiftKey) {
                evento.preventDefault();
                formulario.requestSubmit();
            }
        });

        formulario.addEventListener("submit", async (evento) => {
            evento.preventDefault();
            const texto = pregunta.value.trim();
            if (!texto) return;

            await historialListo;

            bienvenida.hidden = true;
            mostrarUsuario(texto);
            pregunta.value = "";
            sendButton.disabled = true;
            pregunta.disabled = true;
            estado.textContent = modo === "codigo" ? "Preparando tu código..." : "Preparando respuesta...";
            clearButton.disabled = true;
            const cargando = document.createElement("div");
            cargando.className = "loading";
            cargando.textContent = modo === "codigo" ? "Diseñando una solución" : buscarWeb.checked ? "Buscando y consultando" : "Consultando el modelo local";
            conversacion.appendChild(cargando);
            let mensajeEnVivo = null;

            try {
                const respuesta = await fetch("api.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ pregunta: texto, modo, lenguaje: lenguaje.value, buscar_web: buscarWeb.checked })
                });
                if (!respuesta.ok) {
                    const fallo = await respuesta.json();
                    throw new Error(fallo.error || "No se pudo completar la consulta.");
                }

                let contenidoCompleto = "";
                mensajeEnVivo = mostrarRespuestaEnVivo();
                const datos = await leerFlujo(respuesta, (token) => {
                    contenidoCompleto += token;
                    mensajeEnVivo.texto.textContent = contenidoCompleto;
                    mensajeEnVivo.mensaje.scrollIntoView({ behavior: "smooth", block: "nearest" });
                });
                mensajeEnVivo.mensaje.remove();
                mensajeEnVivo = null;
                mostrarRespuesta(contenidoCompleto || "No se recibió ninguna respuesta.", datos.incompleta);
                estado.textContent = datos.fuentes?.length
                    ? `Respuesta con ${datos.fuentes.length} resultados web`
                    : modo === "codigo" ? `Código ${lenguaje.options[lenguaje.selectedIndex].text}` : "Respuesta generada localmente";
            } catch (error) {
                mensajeEnVivo?.mensaje.remove();
                mostrarRespuesta(`No se pudo completar la petición. ${error.message}`);
                estado.textContent = "Comprueba que Ollama esté encendido.";
            } finally {
                cargando.remove();
                clearButton.disabled = false;
                sendButton.disabled = false;
                pregunta.disabled = false;
                pregunta.focus();
            }
        });

        const historialListo = cargarHistorial().catch((error) => {
            estado.textContent = `Memoria local no disponible: ${error.message}`;
        });
    </script>
</body>
</html>