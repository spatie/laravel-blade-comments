This is the start of the page with complex expressions

@php
$baseView = 'includes.include';
$subView = 'include';
$data = [
    'key1' => 'value1',
    'key2' => 'value2',
    'nested' => [
        'key3' => 'value3'
    ]
];
$obj = new \stdClass();
$obj->property = 'test';
@endphp

@include($baseView . '.' . $subView, [
    'data' => $data,
    'complex' => $data['key1'] . '-' . $data['nested']['key3'],
    'object' => (($obj->property ?? 'default') != 'default') ? auth()->user()?->name : 'bla'
])

<p>Some extra HTML to test the regex functionality properly</p>
<div class="font-bold text-success">
    {{ auth()->user()?->ip_previous_login }}
</div>

This is the end of the page
