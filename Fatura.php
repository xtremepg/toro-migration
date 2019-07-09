<?php

class Fatura {
    public static function Listar() {
        GLOBAL $conn_origem;

        $result = $conn_origem->query('SELECT * FROM faturas');

        $faturas = [];

        while($row = $result->fetch_object()) {
            array_push($faturas, $row);
        }

        return $faturas;
    }

    public static function ObterPlano($id_plano) {
        GLOBAL $conn_origem;

        $result = $conn_origem->query('SELECT * FROM planos WHERE id = '. $id_plano .'');

        $plano = null;

        while($row = $result->fetch_object()) {
            $plano = $row;
        }

        return $plano;
    }
}