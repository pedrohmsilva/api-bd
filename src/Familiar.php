<?php

use bd\Connection;

class Familiar
{
    static $text = [
        'cpf',
        'rg',
        'nome',
        'parentesco',
        'fk_prisioneiro'
    ];

    public function listar()
    {
        $sql = "SELECT * FROM familiar";
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function buscar($params)
    {
        $sql = "SELECT f.cpf as cpf_familiar, f.rg as rg_familiar, f.nome as nome_familiar," .
               " f.data_nascimento as data_nascimento_familiar, f.parentesco as parentesco_familiar," . 
               " p.cpf as cpf_prisioneiro, p.rg as rg_prisioneiro, p.nome as nome_prisioneiro," .
               " p.data_nascimento as data_nascimento_prisioneiro, p.observacoes_medicas" .
               " FROM familiar f, prisioneiro p" .
               " WHERE f.cpf = " . $params['cpf'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function criar($params)
    {
        $sql = 
            "INSERT INTO familiar(" . 
                "cpf, " .
                "rg, " .
                "nome, " .
                "data_nascimento, " .
                "parentesco, " .
                "fk_prisioneiro" .
            ") VALUES(" .
                "'" . $params['cpf'] . "', " .
                "'" . $params['rg'] . "', " .
                "'" . $params['nome'] . "', " .
                "date('" . $params['data_nascimento'] . "'), " .
                "'" . $params['parentesco'] . "', " .
                "'" . $params['fk_prisioneiro'] . "'" .
            ")";

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function alterar($params)
    {
        $sql = "UPDATE familiar set ";
        
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
        $sql = "delete from familiar where cpf = " . $params['cpf'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}