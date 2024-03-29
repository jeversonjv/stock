<?php

if (!function_exists("estadosBrasileiros")) {
    function estadosBrasileiros()
    {
        return array(
            "AC" => "Acre",
            "AL" => "Alagoas",
            "AP" => "Amapá",
            "AM" => "Amazonas",
            "BA" => "Bahia",
            "CE" => "Ceará",
            "DF" => "Distrito Federal",
            "ES" => "Espírito Santo",
            "GO" => "Goiás",
            "MA" => "Maranhão",
            "MT" => "Mato Grosso",
            "MS" => "Mato Grosso do Sul",
            "MG" => "Minas Gerais",
            "PA" => "Pará",
            "PB" => "Paraíba",
            "PR" => "Paraná",
            "PE" => "Pernambuco",
            "PI" => "Piauí",
            "RJ" => "Rio de Janeiro",
            "RN" => "Rio Grande do Norte",
            "RS" => "Rio Grande do Sul",
            "RO" => "Rondônia",
            "RR" => "Roraima",
            "SC" => "Santa Catarina",
            "SP" => "São Paulo",
            "SE" => "Sergipe",
            "TO" => "Tocantins",
        );
    }
}

if (!function_exists("getMesesCompleto")) {
    function getMesesCompleto()
    {
        return array(
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro",
        );
    }
}

if (!function_exists("getMesesAbreviado")) {
    function getMesesAbreviado()
    {
        return array(
            "Jan",
            "Fev",
            "Mar",
            "Abr",
            "Maio",
            "Jun",
            "Jul",
            "Ago",
            "Set",
            "Out",
            "Nov",
            "Dez",
        );
    }
}

if (!function_exists("carregarDadosPost")) {
    function carregarDadosPost($post, $ignoreFields = [])
    {
        $arr = [];
        foreach ($post as $key => $value) {
            if (!is_array($value) && !in_array($key, $ignoreFields)) {
                $arr[$key] = !$value ? null : $value;
            }

        }
        return $arr;
    }
}

if (!function_exists("carregarDadosPostArray")) {
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

    function carregarDadosPostArray($post)
    {
        $arr = [];
        foreach ($post as $keyPost => $valuePost) {
            if (is_array($valuePost)) {
                foreach ($valuePost as $idxArrayPost => $valueArrayPost) {
                    $arr[$idxArrayPost][$keyPost] = !$valueArrayPost ? null : $valueArrayPost;
                }
            }
        }
        return $arr;
    }
}

if (!function_exists("dd")) {
    function dd($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die();
    }
}

if (!function_exists("trataDinheiro")) {
    function trataDinheiro($dinheiro)
    {
        return str_replace([".", ","], ["", "."], $dinheiro);
    }
}

if (!function_exists("getTimeAleatorio")) {
    function getTimeAleatorio()
    {
        $hora_aleatoria = random_int(0, 23);
        $minuto_aleatorio = random_int(0, 59);
        $segundo_aleatorio = random_int(0, 59);

        $time = $hora_aleatoria < 10 ? "0" . $hora_aleatoria : $hora_aleatoria;
        $time .= ":" . ($minuto_aleatorio < 10 ? "0" . $minuto_aleatorio : $minuto_aleatorio);
        $time .= ":" . ($segundo_aleatorio < 10 ? "0" . $segundo_aleatorio : $segundo_aleatorio);

        return $time;
    }
}
