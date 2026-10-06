<?php
require_once __DIR__ . "/Ordaingarria.php";

class Txartela implements Ordaingarria
{
    public function ordaindu(float $zenbatekoa): bool
    {
        if ($zenbatekoa <= 0) {
            return false;
        }

        echo number_format($zenbatekoa, 2, ",", ".") . " € txartelarekin ordaindu da.";
        return true;
    }
}