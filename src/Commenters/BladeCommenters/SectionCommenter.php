<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class SectionCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/@section\([\'\"](.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- Start section: $1 -->$0';
    }
}
