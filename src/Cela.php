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
               " fk_cela = " . $params['id_cela'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function buscar($params)
    {
        $sql = "SELECT c.id_cela, c.fk_bloco, c.codigo, c.quantidade_max, c.tipo," .
               " b.numero as numero_bloco, b.andar as andar_bloco," .
               " p.id_pavilhao as pavilhao, p.numero as numero_pavilhao, p.funcao as funcao_pavilhao," .
               " u.codigo as codigo_unidade, u.nome, u.rua, u.bairro, u.cidade, u.uf, u.cep" .
               " FROM cela c, bloco b, pavilhao p, unidade_prisional u" .
               " WHERE c.fk_bloco = b.id_bloco AND b.fk_pavilhao = p.id_pavilhao AND p.fk_unid_prisional = u.codigo" .
               " AND id_cela = " . $params['id_cela'];
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