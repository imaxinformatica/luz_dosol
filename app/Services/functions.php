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
    $extension = '.'.$originalImage->extension();
    $fileName = $name_image.date('Ymd').time().microtime();
    $fileName = str_replace('.', '', $fileName);
    $fileName = str_replace(' ', '', $fileName).$extension;

    return $fileName;
}

function datasArray($data_inicio, $data_fim = null): array
{
    $data_fim = !$data_fim ? date('d-m-Y') : $data_fim;

    $data_fim = explode('-',$data_fim);
    $data_fim[0] = '01';
    $data_fim = implode('-', $data_fim);

    $data_inicio = explode('-',$data_inicio);
    $data_inicio[0] = '01';
    $data_inicio = implode('-', $data_inicio);
    
    list($dia, $mes, $ano) = explode( "-",$data_inicio);
    
    $dataInicial = getdate(strtotime($data_inicio));
    $dataFinal = getdate(strtotime($data_fim));
    	
    $dif = ( ($dataFinal[0] - $dataInicial[0]) / 86400 );
	$meses = round($dif/30)+1;  // +1 serve para adiconar a data fim no array
 
	for($x = 0; $x < $meses; $x++){
		$datas[] =  date("m/Y",strtotime("+".$x." month",mktime(0, 0, 0,$mes,$dia,$ano)));
	}

  	return $datas;
}

function limpaCPF_CNPJ($valor){
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    return $valor;
}
function numberPhone($valor){
    $valor = trim($valor);
    $arrayRemove = [' ', '-', '(', ')'];
    $valor = str_replace($arrayRemove, "", $valor);
    $number['dd'] = substr($valor, 0, 2);
    $number['num']  = substr($valor, 2);
    return $number;
}