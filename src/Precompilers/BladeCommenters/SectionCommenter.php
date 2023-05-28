<?php

namespace Spatie\BladePaths\Precompilers\BladeCommenters;

class SectionCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/@section\([\'\"](.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- Start Section: $1 -->$0';
    }
}
