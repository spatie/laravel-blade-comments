<?php

namespace Spatie\BladePaths\Precompilers\BladeCommenters;

class IncludeIfCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/@includeIf\([\'\"](.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- Start Include: $1 -->$0<!-- End Include: $1 -->';
    }
}
