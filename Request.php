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
            'valor' => '10',
            'quantidade' => '20',
            'data_venda' => '2018-06-23',
            'fk_unid_prisional' => 1,
            'fk_fornecedor' => '1010'
        ];

        // $send = [
        //     'id_pavilhao' => 2
        // ];

        $url = 'http://localhost/prision/bd-api/fornecedores/criar-venda';
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