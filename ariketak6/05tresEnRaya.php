<?php
session_start();

if (!isset($_SESSION["erabiltzailea"])) {
    header("Location: 04ariketaLogin.php?errorea=" . urlencode("Hasi saioa jolastu aurretik"));
    exit;
}

$erabiltzailea = htmlspecialchars($_SESSION["erabiltzailea"], ENT_QUOTES, "UTF-8");
?>
<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3 en raya</title>
    <style>
        :root {
            --fondo: #f4f1ea;
            --texto: #202124;
            --rojo: #c94c4c;
            --azul: #2f6690;
            --casilla: #fffdf8;
        }

        * { box-sizing: border-box; }
        body {
            align-items: center;
            background: var(--fondo);
            color: var(--texto);
            display: flex;
            font-family: Georgia, "Times New Roman", serif;
            justify-content: center;
            margin: 0;
            min-height: 100vh;
            padding: 24px;
        }
        main { max-width: 420px; text-align: center; width: 100%; }
        h1 { margin: 0 0 8px; }
        .bienvenida { margin: 0 0 24px; }
        #estado { font-weight: bold; min-height: 24px; }
        .dificultad { margin: 0 auto 16px; }
        .dificultad select {
            border: 1px solid var(--texto);
            border-radius: 4px;
            font: inherit;
            margin-left: 6px;
            padding: 6px 8px;
        }
        .tablero {
            display: grid;
            gap: 8px;
            grid-template-columns: repeat(3, 1fr);
            margin: 20px auto;
            max-width: 360px;
        }
        .casilla {
            aspect-ratio: 1;
            background: var(--casilla);
            border: 2px solid var(--texto);
            border-radius: 6px;
            color: var(--azul);
            cursor: pointer;
            font-size: clamp(2.5rem, 15vw, 5rem);
            font-weight: bold;
            line-height: 1;
        }
        .casilla:disabled { cursor: default; }
        .casilla.ia { color: var(--rojo); }
        button#reiniciar {
            background: var(--texto);
            border: 0;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            font: inherit;
            padding: 10px 18px;
        }
    </style>
</head>
<body>
    <main>
        <h1>3 en raya</h1>
        <p class="bienvenida">Jokalaria: <?php echo $erabiltzailea; ?> | Zu: X - IA: O</p>
        <p class="dificultad">
            <label for="zailtasuna">Dificultad:</label>
            <select id="zailtasuna">
                <option value="facil">Fácil</option>
                <option value="intermedio">Intermedio</option>
                <option value="dificil">Difícil</option>
            </select>
        </p>
        <p id="estado">Zure txanda da.</p>
        <section class="tablero" aria-label="3 en raya taula">
            <button class="casilla" data-posizioa="0" aria-label="1. casilla"></button>
            <button class="casilla" data-posizioa="1" aria-label="2. casilla"></button>
            <button class="casilla" data-posizioa="2" aria-label="3. casilla"></button>
            <button class="casilla" data-posizioa="3" aria-label="4. casilla"></button>
            <button class="casilla" data-posizioa="4" aria-label="5. casilla"></button>
            <button class="casilla" data-posizioa="5" aria-label="6. casilla"></button>
            <button class="casilla" data-posizioa="6" aria-label="7. casilla"></button>
            <button class="casilla" data-posizioa="7" aria-label="8. casilla"></button>
            <button class="casilla" data-posizioa="8" aria-label="9. casilla"></button>
        </section>
        <button id="reiniciar" type="button">Berriro jokatu</button>
    </main>

    <script>
        const casillas = [...document.querySelectorAll(".casilla")];
        const estado = document.querySelector("#estado");
        const zailtasuna = document.querySelector("#zailtasuna");
        let taula = Array(9).fill("");
        let partidaAmaituta = false;

        const irabaztekoKonbinazioak = [
            [0, 1, 2], [3, 4, 5], [6, 7, 8],
            [0, 3, 6], [1, 4, 7], [2, 5, 8],
            [0, 4, 8], [2, 4, 6]
        ];

        function irabazlea(jokalaria) {
            return irabaztekoKonbinazioak.some(konbinazioa =>
                konbinazioa.every(posizioa => taula[posizioa] === jokalaria)
            );
        }

        function taulaBeteta() {
            return taula.every(kasilla => kasilla !== "");
        }

        function mugimenduIrabazlea(jokalaria) {
            for (let posizioa = 0; posizioa < taula.length; posizioa++) {
                if (taula[posizioa] !== "") continue;
                taula[posizioa] = jokalaria;
                const irabaziDu = irabazlea(jokalaria);
                taula[posizioa] = "";
                if (irabaziDu) return posizioa;
            }
            return null;
        }

        function minimax(jokalaria, sakonera) {
            if (irabazlea("O")) return 10 - sakonera;
            if (irabazlea("X")) return sakonera - 10;
            if (taulaBeteta()) return 0;

            const emaitzak = [];
            for (let posizioa = 0; posizioa < taula.length; posizioa++) {
                if (taula[posizioa] !== "") continue;
                taula[posizioa] = jokalaria;
                const hurrengoJokalaria = jokalaria === "O" ? "X" : "O";
                emaitzak.push(minimax(hurrengoJokalaria, sakonera + 1));
                taula[posizioa] = "";
            }
            return jokalaria === "O" ? Math.max(...emaitzak) : Math.min(...emaitzak);
        }

        function mugimenduZailaAukeratu() {
            let mugimendurikOnena = null;
            let puntuaziorikOnena = -Infinity;
            for (let posizioa = 0; posizioa < taula.length; posizioa++) {
                if (taula[posizioa] !== "") continue;
                taula[posizioa] = "O";
                const puntuazioa = minimax("X", 1);
                taula[posizioa] = "";
                if (puntuazioa > puntuaziorikOnena) {
                    puntuaziorikOnena = puntuazioa;
                    mugimendurikOnena = posizioa;
                }
            }
            return mugimendurikOnena;
        }

        function mugimenduaAukeratu() {
            const hutsuneak = taula
                .map((kasilla, posizioa) => kasilla === "" ? posizioa : null)
                .filter(posizioa => posizioa !== null);

            if (zailtasuna.value === "dificil") return mugimenduZailaAukeratu();
            if (zailtasuna.value === "intermedio") {
                const irabaztekoMugimendua = mugimenduIrabazlea("O");
                if (irabaztekoMugimendua !== null) return irabaztekoMugimendua;
                const blokeatzekoMugimendua = mugimenduIrabazlea("X");
                if (blokeatzekoMugimendua !== null) return blokeatzekoMugimendua;
            }
            return hutsuneak[Math.floor(Math.random() * hutsuneak.length)];
        }

        function marraztu() {
            casillas.forEach((casilla, posizioa) => {
                casilla.textContent = taula[posizioa];
                casilla.disabled = partidaAmaituta || taula[posizioa] !== "";
                casilla.classList.toggle("ia", taula[posizioa] === "O");
            });
        }

        function egiaztatuAmaiera() {
            if (irabazlea("X")) {
                estado.textContent = "Irabazi duzu!";
                partidaAmaituta = true;
            } else if (irabazlea("O")) {
                estado.textContent = "IAk irabazi du.";
                partidaAmaituta = true;
            } else if (taulaBeteta()) {
                estado.textContent = "Berdinketa.";
                partidaAmaituta = true;
            }
            marraztu();
            return partidaAmaituta;
        }

        function iaJokatu() {
            const posizioa = mugimenduaAukeratu();
            if (posizioa !== null && posizioa !== undefined) taula[posizioa] = "O";
            egiaztatuAmaiera();
            if (!partidaAmaituta) estado.textContent = "Zure txanda da.";
        }

        casillas.forEach(casilla => casilla.addEventListener("click", () => {
            const posizioa = Number(casilla.dataset.posizioa);
            if (partidaAmaituta || taula[posizioa] !== "") return;
            taula[posizioa] = "X";
            if (!egiaztatuAmaiera()) {
                estado.textContent = "IA pentsatzen ari da...";
                casillas.forEach(botoia => botoia.disabled = true);
                window.setTimeout(iaJokatu, 450);
            }
        }));

        document.querySelector("#reiniciar").addEventListener("click", () => {
            taula = Array(9).fill("");
            partidaAmaituta = false;
            estado.textContent = "Zure txanda da.";
            marraztu();
        });

        marraztu();
    </script>
</body>
</html>
