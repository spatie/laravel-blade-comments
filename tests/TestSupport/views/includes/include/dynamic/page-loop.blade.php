This is the start of the page with loop includes

@php
    $items = ['one', 'two', 'three'];
    $views = [
        'includes.include.include',
        'includes.include.include',
        'includes.include.include'
    ];
@endphp

@foreach($items as $index => $item)
    @include($views[$index], ['item' => $item, 'index' => $index])
@endforeach

This is the end of the page
