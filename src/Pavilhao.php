<?php

use bd\Connection;

class Pavilhao
{
    static $text = [
        'funcao'
    ];

    public function listar()
    {
        $sql = "SELECT * FROM pavilhao";
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function buscar($params)
    {
        $sql = "SELECT p.numero, p.funcao, p.fk_unid_prisional," .
               " u.codigo as codigo_unidade, u.nome as nome_unidade, u.tipo_logradouro, u.logradouro, u.num, u.bairro, u.cidade, u.uf, u.cep" .
               " FROM pavilhao p, unidade_prisional u" .
               " WHERE p.fk_unid_prisional = u.codigo" .
               " AND numero = " . $params['numero'] .
               " AND fk_unid_prisional = " . $params['fk_unid_prisional'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function blocos($params)
    {
        $sql = "SELECT * FROM bloco WHERE fk_numero_pavilhao = " . $params['fk_numero_pavilhao'] . 
               " AND fk_codigo_unidade = " . $params['fk_codigo_unidade'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function criar($params)
    {
        $sql = 
            "INSERT INTO pavilhao(" . 
                "fk_unid_prisional, " .
                "numero, " .
                "funcao" .
            ") VALUES(" .
                "" . $params['fk_unid_prisional'] . ", " .
                "" . $params['numero'] . ", " .
                "'" . $params['funcao'] . "'" .
            ")";

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function alterar($params)
    {
        $sql = "UPDATE pavilhao set ";
        
        $array_values = [];
        foreach ($params as $key => $value) {
            if ($key != 'numero' && $key != 'fk_unid_prisional') {
                $array_values[] = $key."=".(in_array($key, self::$text) ? "'".$value."'" : $value);
            }
        }
        
        $values = implode(',', $array_values);
        $sql .= $values . " WHERE numero = " . $params['numero'] .
        " AND fk_unid_prisional = " . $params['fk_unid_prisional'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function remover($params)
    {
        $sql = "delete from pavilhao where numero = " . $params['numero'] . 
               " AND fk_unid_prisional = " . $params['fk_unid_prisional'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}