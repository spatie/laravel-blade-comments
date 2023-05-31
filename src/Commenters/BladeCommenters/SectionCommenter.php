<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class SectionCommenter implements BladeCommenterWithCallback
{
    public function pattern(): string
    {
        return "/@yield(\((?:[^)(]+|(?1))*+\))(?![^<>]*<\/title>)/";
    }

    public function replacementCallback(array $matches): string
    {
        preg_match('/@yield\(\'([^\']+)\'/', $matches[0], $parameters);
        $name = $parameters[1];

        return "<!-- Start section: $name -->{$matches[0]}<!-- End section: $name -->";
    }
}
