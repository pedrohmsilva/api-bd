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
        $sql = "SELECT * FROM servidor WHERE cpf = " . $params['cpf'];
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
                "fk_pavilhao" .
            ") VALUES(" .
                "'" . $params['cpf'] . "', " .
                "'" . $params['nome'] . "', " .
                "date('" . $params['data_nascimento'] . "'), " .
                "'" . $params['cargo'] . "', " .
                "" . $params['salario'] . ", " .
                "" . $params['fk_pavilhao'] . "" .
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