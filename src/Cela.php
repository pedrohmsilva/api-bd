<?php

use bd\Connection;

class Cela
{
    static $text = [
        'tipo'
    ];

    public function listar()
    {
        $sql = "SELECT * FROM cela";
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function buscar($params)
    {
        $sql = "SELECT * FROM cela WHERE id_cela = " . $params['id_cela'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function criar($params)
    {
        $sql = 
            "INSERT INTO cela(" . 
                "fk_bloco, " .
                "codigo, " .
                "quantidade_max, " .
                "tipo" .
            ") VALUES(" .
                "" . $params['fk_bloco'] . ", " .
                "" . $params['codigo'] . ", " .
                "" . $params['quantidade_max'] . ", " .
                "'" . $params['tipo'] . "'" .
            ")";

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function alterar($params)
    {
        $sql = "UPDATE cela set ";
        
        $array_values = [];
        foreach ($params as $key => $value) {
            if ($key != 'id_cela') {
                $array_values[] = $key."=".(in_array($key, self::$text) ? "'".$value."'" : $value);
            }
        }
        
        $values = implode(',', $array_values);
        $sql .= $values . " WHERE id_cela = ";
        $sql .= $params['id_cela'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function remover($params)
    {
        $sql = "delete from cela where id_cela = " . $params['id_cela'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}