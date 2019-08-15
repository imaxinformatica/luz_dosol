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