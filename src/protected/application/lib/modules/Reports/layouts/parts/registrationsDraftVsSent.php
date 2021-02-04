<?php
use MapasCulturais\i;

//Recebe os valores do sistema
$label = [i::__('Rascunhos'), i::__('Enviadas')];
$values = [];
$height = '30vh';
$width = '10%';
$total = 0;
$title = i::__('Rascunhos X Enviadas');

//Prepara os dados para o gráfico
foreach ($data as $key => $value) {
    if ($key == i::__('Rascunho')) {
        $values[0] = $value;
        $colors[0] = is_callable($color) ? $color() : $color;
    } else {
        $total = ($total + $value);
        $values[1] = $total;
        $colors[1] = is_callable($color) ? $color() : $color;
    }
}

// Imprime o gráfico na tela
$this->part('charts/pie', [
    'serie' => [
        ['label' => $label[0], 'data' => $values[0], 'colors' => $colors[0]],
        ['label' => $label[1], 'data' => $values[1], 'colors' => $colors[1]],
    ],
    'height' => $height,
    'width' => $width,
    'legends' => $label,
    'colors' => $colors,
    'title' => $title,
]);
