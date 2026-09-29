<?php
require_once __DIR__ . "/IrudiGeometrikoa.php";

class Triangelua extends IrudiGeometrikoa
{
    private $oinarria;
    private $altuera;

    public function getOinarria()
    {
        return $this->oinarria;
    }

    public function setOinarria($oinarria)
    {
        $this->oinarria = $oinarria;
    }

    public function getAltuera()
    {
        return $this->altuera;
    }

    public function setAltuera($altuera)
    {
        $this->altuera = $altuera;
    }

    public function idatzi()
    {
        parent::idatzi();
        echo "Altuera: " . htmlspecialchars((string) $this->altuera) . "<br>";
        echo "Oinarria: " . htmlspecialchars((string) $this->oinarria) . "<br>";
    }

    public function areaKalkulatu()
    {
        $area = ($this->oinarria * $this->altuera) / 2;
        echo "Triangeluaren area: " . $area . "<br>";
        return $area;
    }
}