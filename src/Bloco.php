<?php

use bd\Connection;

class Bloco
{
    static $text = [];

    public function listar()
    {
        $sql = "SELECT * FROM bloco";
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function buscar($params)
    {
        $sql = "SELECT b.fk_numero_pavilhao, b.fk_codigo_unidade, b.numero, b.andar," .
               " p.funcao as funcao_pavilhao," .
               " u.codigo as codigo_unidade, u.nome as nome_unidade, u.logradouro, u.num, u.bairro, u.cidade, u.uf, u.cep" .
               " FROM bloco b, pavilhao p, unidade_prisional u" .
               " WHERE b.fk_numero_pavilhao = p.numero" .
               " AND p.fk_unid_prisional = u.codigo" .
               " AND b.fk_numero_pavilhao = " . $params['fk_numero_pavilhao'] .
               " AND b.numero = " . $params['numero'];
        
        
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function celas($params)
    {
        $sql = "SELECT * FROM cela WHERE fk_numero_bloco = " . $params['fk_numero_bloco'] . " AND fk_numero_pavilhao = " . $params['fk_numero_pavilhao'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function criar($params)
    {
        $sql = 
            "INSERT INTO bloco(" . 
                "fk_numero_pavilhao, " .
                "fk_codigo_unidade, " .
                "numero, " .
                "andar" .
            ") VALUES(" .
                "" . $params['fk_numero_pavilhao'] . ", " .
                "" . $params['fk_codigo_unidade'] . ", " .
                "" . $params['numero'] . ", " .
                "" . $params['andar'] . "" .
            ")";

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function alterar($params)
    {
        $sql = "UPDATE bloco set ";
        
        $array_values = [];
        foreach ($params as $key => $value) {
            if ($key != 'numero' && $key != 'fk_numero_pavilhao') {
                $array_values[] = $key."=".(in_array($key, self::$text) ? "'".$value."'" : $value);
            }
        }
        
        $values = implode(',', $array_values);
        $sql .= $values . " WHERE numero = " . $params['numero'];
        $sql .= " AND fk_numero_pavilhao = " . $params['fk_numero_pavilhao'];


        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function remover($params)
    {
        $sql = "delete from bloco where numero = " . $params['numero'];
        $sql .= " AND fk_numero_pavilhao = " . $params['fk_numero_pavilhao'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}