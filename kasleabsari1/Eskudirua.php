<?php
require_once __DIR__ . "/Ordaingarria.php";

class Eskudirua implements Ordaingarria
{
    public function ordaindu(float $zenbatekoa): bool
    {
        if ($zenbatekoa <= 0) {
            return false;
        }

        echo number_format($zenbatekoa, 2, ",", ".") . " € eskudirutan ordaindu da.";
        return true;
    }
}