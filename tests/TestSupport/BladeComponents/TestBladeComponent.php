<?php

namespace Spatie\BladeComments\Tests\TestSupport\BladeComponents;

use Illuminate\View\Component;

class TestBladeComponent extends Component
{
    public function render()
    {
        return view('bladeComponent.component');
    }
}
