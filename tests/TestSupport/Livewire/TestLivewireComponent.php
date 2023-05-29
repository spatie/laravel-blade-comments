<?php

namespace Spatie\BladeComments\Tests\TestSupport\Livewire;

use Livewire\Component;

class TestLivewireComponent extends Component
{
    public function render()
    {
        return view('livewire.component');
    }
}
