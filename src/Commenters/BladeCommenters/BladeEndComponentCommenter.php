<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class BladeEndComponentCommenter implements BladeCommenter
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
