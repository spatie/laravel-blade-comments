<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class DynamicIncludeCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/@include\(([^'\",\)]+)(?:,\s*(?:\[.*?\])?)?\)/s";
    }

    public function replacement(): string
    {
        return '<!-- Start include: $1 -->$0<!-- End include: $1 -->';
    }
}
