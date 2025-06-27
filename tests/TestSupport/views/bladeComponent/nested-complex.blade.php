@extends('layouts.app')

@section('content')
<div class="container">
    @if(true)
        <div class="outer-wrapper">
            <x:test-component />

            @foreach([1, 2] as $item)
                <div class="loop-{{ $item }}">
                    <x:test-component />

                    @if($item === 1)
                        <div class="nested-condition">
                            <x:test-component />
                            @include('partials.item', ['item' => $item])
                            <x:test-component />
                        </div>
                    @else
                        <div class="else-condition">
                            <x:test-component />
                        </div>
                    @endif

                    <x:test-component />
                </div>
            @endforeach

            <x:test-component />
        </div>
    @endif

    @component('components.custom')
        <div class="slot-content">
            <x:test-component />
            @yield('nested-section', 'Default content')
            <x:test-component />
        </div>
    @endcomponent
</div>
@endsection
