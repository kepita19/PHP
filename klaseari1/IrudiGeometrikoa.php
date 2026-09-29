<?php
class IrudiGeometrikoa
{
    private $izena;
    private $kolorea;

    public function __construct()
    {
    }

    public function getIzena()
    {
        return $this->izena;
    }

    public function setIzena($izena)
    {
        $this->izena = $izena;
    }

    public function getKolorea()
    {
        return $this->kolorea;
    }

    public function setKolorea($kolorea)
    {
        $this->kolorea = $kolorea;
    }

    public function idatzi()
    {
        echo "Izena: " . htmlspecialchars($this->izena) . "<br>";
        echo "Kolorea: " . htmlspecialchars($this->kolorea) . "<br>";
    }
}