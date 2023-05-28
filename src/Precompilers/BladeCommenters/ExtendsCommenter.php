<?php

namespace Spatie\BladePaths\Precompilers\BladeCommenters;

class ExtendsCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/@extends\([\'\"](.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- View Extends: $1 -->$0';
    }
}
