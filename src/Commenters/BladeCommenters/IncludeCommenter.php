<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class IncludeCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/@include\([\'\"](.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- Start include: $1 -->$0<!-- End include: $1 -->';
    }
}
