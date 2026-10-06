<?php
require_once __DIR__ . "/Etsaia.php";

class Goomba extends Etsaia
{
    private int $azkartasuna;

    public function __construct(string $izena, int $biziPuntuak, int $indarra, int $arintasuna, int $boterea, int $azkartasuna)
    {
        parent::__construct($izena, $biziPuntuak, $indarra, $arintasuna, $boterea);
        $this->azkartasuna = $azkartasuna;
    }

    public function mugitu(): string
    {
        return "Goomba mugitu da";
    }

    public function erasoEgin(): int
    {
        return $this->azkartasuna + $this->boterea;
    }
}