<?php

function convertMoneyBraziltoUSA($value)
{
    $value = str_replace(',', '.', str_replace('.', '', $value));
    $value = floatval($value);

    return $value;
}

function convertMoneyUSAtoBrazil($value)
{
    $value = number_format($value, 2, ',', '.');

    return $value;
}

function convertDateBraziltoUSA($date)
{
    $date = implode("-", array_reverse(explode("/", $date)));

    return $date;
}

function convertDateUSAtoBrazil($date)
{
    $date = implode("/", array_reverse(explode("-", $date)));

    return $date;
}

function getNameFile($originalImage, $name_image)
{
    $name_image = rand (1500 , 20000);
    $extension = '.' . $originalImage->extension();
    $fileName = $name_image . date('Ymd') . time() . microtime();
    $fileName = str_replace('.', '', $fileName);
    $fileName = str_replace(' ', '', $fileName) . $extension;

    return $fileName;
}

function datasArray($data_inicio, $data_fim = null): array
{
    $data_fim = !$data_fim ? date('d-m-Y') : $data_fim;

    $data_fim = explode('-', $data_fim);
    $data_fim[0] = '01';
    $data_fim = implode('-', $data_fim);

    $data_inicio = explode('-', $data_inicio);
    $data_inicio[0] = '01';
    $data_inicio = implode('-', $data_inicio);

    list($dia, $mes, $ano) = explode("-", $data_inicio);

    $dataInicial = getdate(strtotime($data_inicio));
    $dataFinal = getdate(strtotime($data_fim));

    $dif = (($dataFinal[0] - $dataInicial[0]) / 86400);
    $meses = round($dif / 30) + 1; // +1 serve para adiconar a data fim no array

    for ($x = 0; $x < $meses; $x++) {
        $datas[] = date("m/Y", strtotime("+" . $x . " month", mktime(0, 0, 0, $mes, $dia, $ano)));
    }

    return $datas;
}

function limpaCPF_CNPJ($valor)
{
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    return $valor;
}

function clearSpecialCaracters(String $string)
{
    $specialCaracters = ['“', '‘', '!', '@', '#', '$', '%', '&', '*', '(', ')', '_', '-', '+', '=', '{', '[', '}', ']', '|', '<', '>', '.', ':', ';', '?', '/'];
    $string = str_replace($specialCaracters, "", $string);
    return $string;
}

function numberPhone($valor)
{
    $valor = trim($valor);
    $arrayRemove = [' ', '-', '(', ')'];
    $valor = str_replace($arrayRemove, "", $valor);
    $number['dd'] = substr($valor, 0, 2);
    $number['num'] = substr($valor, 2);
    return $number;
}

function alteraMedidas()
{
    $products = App\Product::get();
    foreach ($products as $product) {
        $product->volume = $product->height * $product->width * $product->length;
        $product->save();
    }
    return dd($products);
}
function calc_digitos_posicoes( $digitos, $posicoes = 10, $soma_digitos = 0 ) 
{
    // Faz a soma dos digitos com a posição
    // Ex. para 10 posições: 
    //   0    2    5    4    6    2    8    8   4
    // x10   x9   x8   x7   x6   x5   x4   x3  x2
    // 	 0 + 18 + 40 + 28 + 36 + 10 + 32 + 24 + 8 = 196
    for ( $i = 0; $i < strlen( $digitos ); $i++  ) {
        $soma_digitos = $soma_digitos + ( $digitos[$i] * $posicoes );
        $posicoes--;
    }

    // Captura o resto da divisão entre $soma_digitos dividido por 11
    // Ex.: 196 % 11 = 9
    $soma_digitos = $soma_digitos % 11;

    // Verifica se $soma_digitos é menor que 2
    if ( $soma_digitos < 2 ) {
        // $soma_digitos agora será zero
        $soma_digitos = 0;
    } else {
        // Se for maior que 2, o resultado é 11 menos $soma_digitos
        // Ex.: 11 - 9 = 2
        // Nosso dígito procurado é 2
        $soma_digitos = 11 - $soma_digitos;
    }

    // Concatena mais um digito aos primeiro nove digitos
    // Ex.: 025462884 + 2 = 0254628842
    $cpf = $digitos . $soma_digitos;
    
    // Retorna
    return $cpf;
}
