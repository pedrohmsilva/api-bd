<?php

use bd\Connection;

class Fornecedor
{
    static $text = [
        'cnpj',
        'nome_empresa',
        'item_ofertado'
    ];

    public function listar()
    {
        $sql = "SELECT * FROM fornecedor";
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function buscar($params)
    {
        $sql = "SELECT * FROM fornecedor WHERE cnpj = " . $params['cnpj'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function criar($params)
    {
        $sql = 
            "INSERT INTO fornecedor(" . 
                "cnpj, " .
                "nome_empresa, " .
                "item_ofertado" .
            ") VALUES(" .
                "'" . $params['cnpj'] . "', " .
                "'" . $params['nome_empresa'] . "', " .
                "'" . $params['item_ofertado'] . "'" .
            ")";

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function alterar($params)
    {
        $sql = "UPDATE fornecedor set ";
        
        $array_values = [];
        foreach ($params as $key => $value) {
            if ($key != 'cnpj') {
                $array_values[] = $key."=".(in_array($key, self::$text) ? "'".$value."'" : $value);
            }
        }
        
        $values = implode(',', $array_values);
        $sql .= $values . " WHERE cnpj = ";
        $sql .= $params['cnpj'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function remover($params)
    {
        $sql = "delete from fornecedor where cnpj = " . $params['cnpj'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}