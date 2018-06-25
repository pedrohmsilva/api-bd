<?php

use bd\Connection;

class Servidor
{
    static $text = [
        'cpf',
        'nome',
        'cargo'
    ];

    public function listar()
    {
        $sql = "SELECT * FROM servidor";
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function buscar($params)
    {
        $sql = "SELECT s.cpf, s.nome, s.data_nascimento, s.cargo, s.salario," .
               " p.numero as numero_pavilhao, p.funcao as funcao_pavilhao," .
               " u.codigo as codigo_unidade, u.nome as nome_unidade, u.tipo_logradouro, u.logradouro, u.num, u.bairro, u.cidade, u.uf, u.cep" .
               " FROM servidor s, pavilhao p, unidade_prisional u".
               " WHERE s.fk_numero_pavilhao = p.numero AND s.fk_codigo_unidade = p.fk_unid_prisional" .
               " AND p.fk_unid_prisional =  u.codigo" .
               " AND s.cpf = " . $params['cpf'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function criar($params)
    {
        $sql = 
            "INSERT INTO servidor(" . 
                "cpf, " .
                "nome, " .
                "data_nascimento, " .
                "cargo, " .
                "salario, " .
                "fk_codigo_unidade," .
                "fk_numero_pavilhao" .
            ") VALUES(" .
                "'" . $params['cpf'] . "', " .
                "'" . $params['nome'] . "', " .
                "date('" . $params['data_nascimento'] . "'), " .
                "'" . $params['cargo'] . "', " .
                "" . $params['salario'] . ", " .
                "" . $params['fk_codigo_unidade'] . ", " .
                "" . $params['fk_numero_pavilhao'] . "" .
            ")";

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function alterar($params)
    {
        $sql = "UPDATE servidor set ";
        
        $array_values = [];
        foreach ($params as $key => $value) {
            if ($key == 'data_nascimento') {
                $array_values[] = $key."=date('".$value."')";
                continue;
            }
            if ($key != 'cpf') {
                $array_values[] = $key."=".(in_array($key, self::$text) ? "'".$value."'" : $value);
            }
        }
        
        $values = implode(',', $array_values);
        $sql .= $values . " WHERE cpf = ";
        $sql .= $params['cpf'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function remover($params)
    {
        $sql = "delete from servidor where cpf = " . $params['cpf'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}