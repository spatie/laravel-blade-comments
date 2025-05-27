@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Complex Blade Template</h1>
    
    @if(true)
        <div class="conditional-content">
            <x:test-component />
            
            @foreach([1, 2, 3] as $item)
                <div class="loop-item">
                    <x:test-component />
                    @include('partials.item', ['item' => $item])
                </div>
            @endforeach
        </div>
    @endif
    
    @php
        $dynamicComponent = 'test-component';
    @endphp
    
    <x:test-component />
    
    @component('components.custom')
        <x:test-component />
    @endcomponent
</div>
@endsection
