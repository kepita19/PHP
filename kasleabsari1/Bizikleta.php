<?php
require_once __DIR__ . "/Ibilgailua.php";
require_once __DIR__ . "/Mugikorra.php";

class Bizikleta extends Ibilgailua implements Mugikorra
{
    public function mugitu(): string
    {
        return "Pedalei eragin";
    }
}