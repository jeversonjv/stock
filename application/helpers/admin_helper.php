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

if(!function_exists("carregarDadosPOST")) {
    function carregarDadosPOST($post) {
        $arr = [];
        foreach($post as $key => $value) {
            $arr[$key] = !$value ? NULL : $value;
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