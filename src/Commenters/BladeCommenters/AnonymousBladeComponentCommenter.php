<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class AnonymousBladeComponentCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return '/(##BEGIN-COMPONENT-CLASS##@component\(\'Illuminate\\\\View\\\\AnonymousComponent\',\s*\'([^\']+)\'[^\)]*\)[\s\S]*?@endComponentClass##END-COMPONENT-CLASS##)/';
    }

    public function replacement(): string
    {
        return '<!-- Start anonymous component: $2 -->$1<!-- End anonymous component $2 -->';
    }
}
