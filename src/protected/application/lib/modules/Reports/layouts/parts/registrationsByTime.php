<?php

use MapasCulturais\i;

//Recebe os valores do sistema
$count = 0;
$colors = [];
$serie = [];
$height = '40vh';
$width = '100%';
$title = i::__('Total de registro ao longo do tempo');

//Prepara os dados para o gráfico
foreach ($data as $key_data => $values) {
    $tempColor = is_callable($color) ? $color() : $color;
    $serie[$count] = [
        'label' => $key_data,
        'colors' => $tempColor,
        'type' => 'line',
        'fill' => false,
    ];

    $colors[$count] = $tempColor;

    foreach ($values as $key_v => $value) {
        $labels[] = $key_v;
        $serie[$count]['data'][] = $value;
    }
    $count++;
}

$labels = array_unique($labels);
sort($labels);

$dataLabels = array_map(function ($label) {
    return (new DateTime($label))->format('d/m/Y');
}, $labels);

// Imprime o gráfico na tela
$this->part('charts/line', [
    'vertical' => true,
    'title' => $title,
    'labels' => $dataLabels,
    'series' => $serie,
    'height' => $height,
    'width' => $width,
    'legends' => $labels,
    'colors' => $colors,
]);
