<?php

namespace Spatie\BladePaths\Precompilers\BladeCommenters;

class BlandeEndComponentCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return '/@(endComponentClass|endcomponent)/';
    }

    public function replacement(): string
    {
        return '$0<!-- End Blade Component -->';
    }
}
