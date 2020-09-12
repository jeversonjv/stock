<?php

if(!function_exists("estadosBrasileiros")) {
    function estadosBrasileiros () {
        return array(
            "AC"=>"Acre",
            "AL"=>"Alagoas",
            "AP"=>"Amapá",
            "AM"=>"Amazonas",
            "BA"=>"Bahia",
            "CE"=>"Ceará",
            "DF"=>"Distrito Federal",
            "ES"=>"Espírito Santo",
            "GO"=>"Goiás",
            "MA"=>"Maranhão",
            "MT"=>"Mato Grosso",
            "MS"=>"Mato Grosso do Sul",
            "MG"=>"Minas Gerais",
            "PA"=>"Pará",
            "PB"=>"Paraíba",
            "PR"=>"Paraná",
            "PE"=>"Pernambuco",
            "PI"=>"Piauí",
            "RJ"=>"Rio de Janeiro",
            "RN"=>"Rio Grande do Norte",
            "RS"=>"Rio Grande do Sul",
            "RO"=>"Rondônia",
            "RR"=>"Roraima",
            "SC"=>"Santa Catarina",
            "SP"=>"São Paulo",
            "SE"=>"Sergipe",
            "TO"=>"Tocantins"
        );
    }
}

if(!function_exists("carregarDadosPost")) {
    function carregarDadosPost($post) {
        $arr = [];
        foreach($post as $key => $value) {
            if(!is_array($value)) $arr[$key] = !$value ? NULL : $value;
        }
        return $arr;
    }
}

if(!function_exists("carregarDadosPostArray")) {
    /*
        A ideia desse metódo é transformar o post posicional que vem do HTML
        em um array pronto pra ser enviado para o banco de dados.

        Transforma disso:
        $array = [
            "nome" => [123, 147],
            "endereco" => [123, 147],
            "bairro" => [123, 147],
        ];

        Para isso:
        $array = [
            0 => ["nome" => 123, "endereco" => 123, "bairro" => 123],
            1 => ["nome" => 147, "endereco" => 147, "bairro" => 147]
        ];
    */

    function carregarDadosPostArray($post) {
        $arr = [];
        foreach($post as $keyPost => $valuePost) {
            if(is_array($valuePost)) {
                foreach($valuePost as $idxArrayPost => $valueArrayPost) {
                    $arr[$idxArrayPost][$keyPost] = !$valueArrayPost ? NULL : $valueArrayPost;
                }
            }
        }
        return $arr;
    }
}

if(!function_exists("dd")) {
    function dd($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die();
    }
}