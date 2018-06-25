<?php

class Request
{
    public function test()
    {
        // $params = [
        //     'numero' => 10,
        //     'andar' => 20,
        // ];

        // $where = [
        //     [
        //         'field' => 'id_bloco', 
        //         'operator' => '=', 
        //         'value' => 1,
        //         // 'clause' => 1
        //     ]
        // ];

        // $send = [
        //     // 'params' => $params,
        //     'where' => $where
        // ];

        $send = [
            'cpf' => '2',
            'nome' => 'Servidor 2',
            'data_nascimento' => '1910-01-01',
            'cargo' => 'Teste',
            'salario' => 150.2,
            'fk_codigo_unidade' => '1',
            'fk_numero_pavilhao' => '1'
        ];

        // $send = [
        //     'id_pavilhao' => 2
        // ];

        $url = 'http://localhost/prision/bd-api/servidores/remover';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($send));
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }
}