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
               " AND cela.codigo = prisioneiro.fk_cela" .
               " AND bloco.numero = cela.fk_numero_bloco AND bloco.fk_numero_pavilhao = cela.fk_numero_pavilhao" .
               " AND pavilhao.numero = bloco.fk_numero_pavilhao AND pavilhao.fk_unid_prisional = bloco.fk_codigo_unidade" .
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

    public function criar_pena($params)
    {
        $sql = 
            "INSERT INTO cumprimento_pena(" . 
                "fk_prisioneiro, " .
                "fk_pena, " .
                "data_inicio, " .
                "data_termino" .
            ") VALUES(" .
                "'" . $params['fk_prisioneiro'] . "', " .
                "'" . $params['fk_pena'] . "', " .
                "date('" . $params['data_inicio'] . "'), " .
                "date('" . $params['data_termino'] . "')" .
            ")";
        
        $conn = new Connection();
        return json_encode(
            $conn->post($sql)
        );
    }

    public function penas($params)
    {
        $sql = "SELECT codigo_penal, area_judicial, descricao, duracao_max, duracao_min, data_inicio, data_termino" .
               " FROM pena, cumprimento_pena" .
               " WHERE fk_prisioneiro = " . $params['fk_prisioneiro'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
        );
    }

    public function familiares($params)
    {
        $sql = "SELECT * FROM familiar WHERE fk_prisioneiro = " . $params['fk_prisioneiro'];
        $conn = new Connection();
        return json_encode(
            $conn->get($sql)
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