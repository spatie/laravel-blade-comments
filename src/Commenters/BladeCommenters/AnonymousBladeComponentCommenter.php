<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class AnonymousBladeComponentCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/(?<=@component\('Illuminate\\View\\AnonymousComponent',\s*')([^']+)'\s*,\s*\[([^\]]*)\]\s*\))/s";
    }

    public function replacement(): string
    {
        return '<!-- Start anonymous Blade component $1 -->$0<!-- End anonymous Blade component $1 -->
';
    }
}
