<?php

namespace Spatie\BladePaths\Tests\TestSupport\Livewire;

use Livewire\Component;

class TestLivewireComponent extends Component
{
    public function render()
    {
        return view('livewire.component');
    }
}
