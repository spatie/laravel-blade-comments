This is the start of the page with ternary operators

@php
$condition = true;
$viewA = 'includes.include.include';
$viewB = 'includes.include.include';
$data = [
    'key' => 'value',
    'condition' => $condition
];
@endphp

@include($condition ? $viewA : $viewB, [
    'ternary' => $condition ? 'true value' : 'false value',
    'nested' => $data['condition'] ? $data['key'] : 'default'
])

This is the end of the page
