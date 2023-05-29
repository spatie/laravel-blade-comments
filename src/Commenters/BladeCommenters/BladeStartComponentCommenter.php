<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class BladeStartComponentCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/@component\([\'\"](.*?)[\'\"].*?\)/";
    }

    public function replacement(): string
    {
        return '<!-- Blade Component: $1 -->$0';
    }
}
