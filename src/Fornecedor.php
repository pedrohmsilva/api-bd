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

    public function vendas($params)
    {
        $sql = "SELECT * FROM vendas WHERE fk_fornecedor = " . $params['cnpj'];
        if (isset($params['fk_unid_prisional'])) {
            $sql .= " AND fk_unid_prisional = " . $params['fk_unid_prisional'];
        }
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

    public function criar_venda($params)
    {
        $sql = 
            "INSERT INTO vendas(" . 
                "valor, " .
                "quantidade, " .
                "data_venda, " .
                "fk_unid_prisional, " .
                "fk_fornecedor" .
            ") VALUES(" .
                "" . $params['valor'] . ", " .
                "" . $params['quantidade'] . ", " .
                "date('" . $params['data_venda'] . "'), " .
                "" . $params['fk_unid_prisional'] . ", " .
                "'" . $params['fk_fornecedor'] . "'" .
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