<?php

use bd\Connection;

class UnidadePrisional
{
    static $text = [
        'nome',
        'tipo_logradouro',
        'logradouro',
        'num',
        'bairro',
        'cidade',
        'uf',
        'cep'
    ];

    public function listar()
    {
        $sql = "SELECT * FROM unidade_prisional";
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function buscar($params)
    {
        $sql = "SELECT * FROM unidade_prisional WHERE codigo = " . $params['codigo'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function pavilhoes($params)
    {
        $sql = "SELECT * FROM pavilhao WHERE fk_unid_prisional = " . $params['codigo'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function criar($params)
    {
        $sql = 
            "INSERT INTO unidade_prisional(" . 
                "nome, " .
                "tipo_logradouro, " .
                "logradouro, " .
                "num, " .
                "bairro, " .
                "cidade, " .
                "uf, " .
                "cep" .
            ") VALUES(" .
                "'" . $params['nome'] . "', " .
                "'" . $params['tipo_logradouro'] . "', " .
                "'" . $params['logradouro'] . "', " .
                "'" . $params['num'] . "', " .
                "'" . $params['bairro'] . "', " .
                "'" . $params['cidade'] . "', " .
                "'" . $params['uf'] . "', " .
                "'" . $params['cep'] . "'" .
            ")";

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function alterar($params)
    {
        $sql = "UPDATE unidade_prisional set ";
        
        $array_values = [];
        foreach ($params as $key => $value) {
            if ($key != 'codigo') {
                $array_values[] = $key."=".(in_array($key, self::$text) ? "'".$value."'" : $value);
            }
        }
        
        $values = implode(',', $array_values);
        $sql .= $values . " WHERE codigo = ";
        $sql .= $params['codigo'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function remover($params)
    {
        $sql = "delete from unidade_prisional where codigo = " . $params['codigo'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}