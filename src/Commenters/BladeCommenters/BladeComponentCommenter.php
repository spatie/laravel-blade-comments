<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class BladeComponentCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return '/(?<!@component\(\'Illuminate\\\\View\\\\AnonymousComponent\'|\s)@component\(\'([\w\\\\]+)\',\s*(\'[^\']*\'|"[^"]*")\s*,\s*\[(?s:.*)\]\)(?s:.+?)@endComponentClass(?!\s*\()/sU';
    }

    public function replacement(): string
    {
        return "<!-- Start component $1 $2 -->$0<!-- End component $1 $2 -->";
    }
}
