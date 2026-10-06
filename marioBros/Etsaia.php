<?php
require_once __DIR__ . "/Pertsonaia.php";

abstract class Etsaia extends Pertsonaia
{
    protected int $boterea;

    public function __construct(string $izena, int $biziPuntuak, int $indarra, int $arintasuna, int $boterea)
    {
        parent::__construct($izena, $biziPuntuak, $indarra, $arintasuna);
        $this->boterea = $boterea;
    }

    abstract public function mugitu(): string;

    abstract public function erasoEgin(): int;
}