<?php
require_once __DIR__ . "/Etsaia.php";

class Koopa extends Etsaia
{
    private bool $oskolBerdeaDa;
    private int $azkartasuna;

    public function __construct(string $izena, int $biziPuntuak, int $indarra, int $arintasuna, int $boterea, int $azkartasuna, bool $oskolBerdeaDa)
    {
        parent::__construct($izena, $biziPuntuak, $indarra, $arintasuna, $boterea);
        $this->azkartasuna = $azkartasuna;
        $this->oskolBerdeaDa = $oskolBerdeaDa;
    }

    public function mugitu(): string
    {
        return "Koopa mugitu da";
    }

    public function erasoEgin(): int
    {
        return $this->oskolBerdeaDa ? $this->azkartasuna * 2 : $this->azkartasuna;
    }

    public function getOskolBerdeaDa(): bool
    {
        return $this->oskolBerdeaDa;
    }
}