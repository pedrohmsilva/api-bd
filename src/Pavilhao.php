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
        $sql = "SELECT p.id_pavilhao, p.fk_unid_prisional, p.numero, p.funcao," .
               " u.codigo as codigo_unidade, u.nome as nome_unidade, u.rua, u.bairro, u.cidade, u.uf, u.cep" .
               " FROM pavilhao p, unidade_prisional u" .
               " WHERE p.fk_unid_prisional = u.codigo" .
               " AND id_pavilhao = " . $params['id_pavilhao'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function blocos($params)
    {
        $sql = "SELECT * FROM bloco WHERE fk_pavilhao = " . $params['id_pavilhao'];
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
                "'" . $params['fk_unid_prisional'] . "', " .
                "'" . $params['numero'] . "', " .
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
            if ($key != 'id_pavilhao') {
                $array_values[] = $key."=".(in_array($key, self::$text) ? "'".$value."'" : $value);
            }
        }
        
        $values = implode(',', $array_values);
        $sql .= $values . " WHERE id_pavilhao = ";
        $sql .= $params['id_pavilhao'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function remover($params)
    {
        $sql = "delete from pavilhao where id_pavilhao = " . $params['id_pavilhao'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}