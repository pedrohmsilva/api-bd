<?php

use bd\Connection;

class Pena
{
    static $text = [
        'codigo_penal',
        'area_judicial',
        'descricao'
    ];

    public function listar()
    {
        $sql = "SELECT * FROM pena";
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function buscar($params)
    {
        $sql = "SELECT * FROM pena WHERE codigo_penal = " . $params['codigo_penal'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function criar($params)
    {
        $sql = 
            "INSERT INTO pena(" . 
                "codigo_penal, " .
                "area_judicial, " .
                "descricao, " .
                "duracao_max, " .
                "duracao_min" .
            ") VALUES(" .
                "'" . $params['codigo_penal'] . "', " .
                "'" . $params['area_judicial'] . "', " .
                "'" . $params['descricao'] . "', " .
                "" . $params['duracao_max'] . ", " .
                "" . $params['duracao_min'] . "" .
            ")";

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function alterar($params)
    {
        $sql = "UPDATE pena set ";
        
        $array_values = [];
        foreach ($params as $key => $value) {
            if ($key != 'codigo_penal') {
                $array_values[] = $key."=".(in_array($key, self::$text) ? "'".$value."'" : $value);
            }
        }
        
        $values = implode(',', $array_values);
        $sql .= $values . " WHERE codigo_penal = ";
        $sql .= $params['codigo_penal'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function remover($params)
    {
        $sql = "delete from pena where codigo_penal = " . $params['codigo_penal'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}