<?php

use bd\Connection;

class Prisioneiro
{
    static $text = [
        'cpf',
        'rg',
        'nome',
        'observacoes_medicas'
    ];

    public function listar()
    {
        $sql = "SELECT * FROM prisioneiro";
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function buscar($params)
    {
        $sql = "SELECT cpf, rg, prisioneiro.nome, data_nascimento, observacoes_medicas, cela.codigo as cela, bloco.numero as bloco, andar," .
               " pavilhao.numero as pavilhao, unidade_prisional.codigo as codigo_unidade, unidade_prisional.nome as nome_unidade" .
               " FROM prisioneiro, cela, bloco, pavilhao, unidade_prisional" .
               " WHERE cpf = " . $params['cpf'] .
               " AND cela.id_cela = prisioneiro.fk_cela" .
               " AND bloco.id_bloco = cela.fk_bloco" .
               " AND pavilhao.id_pavilhao = bloco.fk_pavilhao" .
               " AND unidade_prisional.codigo = pavilhao.fk_unid_prisional";
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function criar($params)
    {
        $sql = 
            "INSERT INTO prisioneiro(" . 
                "cpf, " .
                "rg, " .
                "nome, " .
                "data_nascimento, " .
                "observacoes_medicas, " .
                "fk_cela" .
            ") VALUES(" .
                "'" . $params['cpf'] . "', " .
                "'" . $params['rg'] . "', " .
                "'" . $params['nome'] . "', " .
                "date('" . $params['data_nascimento'] . "'), " .
                "'" . $params['observacoes_medicas'] . "', " .
                "" . $params['fk_cela'] . "" .
            ")";

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function alterar($params)
    {
        $sql = "UPDATE prisioneiro set ";
        
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
        $sql = "delete from prisioneiro where cpf = " . $params['cpf'];

        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }
}