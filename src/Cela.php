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

    public function prisioneiros($params)
    {
        $sql = "SELECT * FROM prisioneiro WHERE" .
               " fk_cela = " . $params['codigo'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function buscar($params)
    {
        $sql = "SELECT c.codigo, c.fk_numero_bloco, c.fk_numero_pavilhao, c.quantidade_max, c.tipo," .
               " b.numero as numero_bloco, b.andar as andar_bloco," .
               " p.numero as numero_pavilhao," .
               " u.codigo as codigo_unidade, u.nome, u.tipo_logradouro, u.logradouro, u.num, u.bairro, u.cidade, u.uf, u.cep" .
               " FROM cela c, bloco b, pavilhao p, unidade_prisional u" .
               " WHERE c.fk_numero_bloco = b.numero AND c.fk_numero_pavilhao = b.fk_numero_pavilhao" .
               " AND b.fk_numero_pavilhao = p.numero AND b.fk_codigo_unidade = p.fk_unid_prisional" .
               " AND p.fk_unid_prisional = u.codigo" .
               " AND c.codigo = " . $params['codigo'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function criar($params)
    {
        $sql = 
            "INSERT INTO cela(" . 
                "fk_numero_bloco, " .
                "fk_numero_pavilhao, " .
                "quantidade_max, " .
                "tipo" .
            ") VALUES(" .
                "" . $params['fk_numero_bloco'] . ", " .
                "" . $params['fk_numero_pavilhao'] . ", " .
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
        $sql = "delete from cela where codigo = " . $params['codigo'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}