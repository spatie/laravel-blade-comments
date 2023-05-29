<?php

namespace Spatie\BladePaths\Commenters\BladeCommenters;

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
