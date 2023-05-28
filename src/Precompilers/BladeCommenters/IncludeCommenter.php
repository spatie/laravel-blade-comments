<?php

namespace Spatie\BladePaths\Precompilers\BladeCommenters;

class IncludeCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/@include\([\'\"](.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- Start Include: $1 -->$0<!-- End Include: $1 -->';
    }
}
