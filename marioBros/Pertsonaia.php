<?php
abstract class Pertsonaia
{
    protected string $izena;
    protected int $biziPuntuak;
    protected int $indarra;
    protected int $arintasuna;

    public function __construct(string $izena, int $biziPuntuak, int $indarra, int $arintasuna)
    {
        $this->izena = $izena;
        $this->biziPuntuak = $biziPuntuak;
        $this->indarra = $indarra;
        $this->arintasuna = $arintasuna;
    }

    abstract public function mugitu(): string;

    abstract public function erasoEgin(): int;

    public function minaJaso(int $mina): void
    {
        $this->biziPuntuak = max(0, $this->biziPuntuak - max(0, $mina));
    }

    public function getIzena(): string
    {
        return $this->izena;
    }

    public function getBiziPuntuak(): int
    {
        return $this->biziPuntuak;
    }
}