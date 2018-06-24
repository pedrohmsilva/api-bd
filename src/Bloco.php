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
        $sql = "SELECT b.id_bloco, b.fk_pavilhao as pavilhao, b.numero, b.andar," .
               " p.numero as numero_pavilhao, p.funcao as funcao_pavilhao," .
               " u.codigo as codigo_unidade, u.nome as nome_unidade, u.rua, u.bairro, u.cidade, u.uf, u.cep" .
               " FROM bloco b, pavilhao p, unidade_prisional u" .
               " WHERE b.fk_pavilhao = p.id_pavilhao" .
               " AND p.fk_unid_prisional = u.codigo" .
               " AND id_bloco = " . $params['id_bloco'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function celas($params)
    {
        $sql = "SELECT * FROM cela WHERE fk_bloco = " . $params['id_bloco'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function criar($params)
    {
        $sql = 
            "INSERT INTO bloco(" . 
                "fk_pavilhao, " .
                "numero, " .
                "andar" .
            ") VALUES(" .
                "" . $params['fk_pavilhao'] . ", " .
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
            if ($key != 'id_bloco') {
                $array_values[] = $key."=".(in_array($key, self::$text) ? "'".$value."'" : $value);
            }
        }
        
        $values = implode(',', $array_values);
        $sql .= $values . " WHERE id_bloco = ";
        $sql .= $params['id_bloco'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function remover($params)
    {
        $sql = "delete from bloco where id_bloco = " . $params['id_bloco'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}