<?php
require_once __DIR__ . "/Pertsonaia.php";
require_once __DIR__ . "/Salto.php";

class Luigi extends Pertsonaia implements Salto
{
    private string $gaitasunBerezia;

    public function __construct(string $izena, int $biziPuntuak, int $indarra, int $arintasuna, string $gaitasunBerezia)
    {
        parent::__construct($izena, $biziPuntuak, $indarra, $arintasuna);
        $this->gaitasunBerezia = $gaitasunBerezia;
    }

    public function mugitu(): string
    {
        return "Luigi mugitu da";
    }

    public function erasoEgin(): int
    {
        return $this->indarra + $this->arintasuna;
    }

    public function saltoEgin(): int
    {
        return $this->indarra * $this->arintasuna;
    }

    public function getGaitasunBerezia(): string
    {
        return $this->gaitasunBerezia;
    }
}