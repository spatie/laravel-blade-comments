<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class SectionCommenter implements BladeCommenterWithCallback
{
    public function pattern(): string
    {
        $excludes = config('blade-comments.excludes.sections', []);

        if (count($excludes)) {
            $excludesRegex = '(?!\s*[\'"](?:'.implode('|', $excludes).')[\'"])';
            $regex = "/@yield(\({$excludesRegex}(?:[^)(]+|(?1))*+\))(?![^<>]*<\/title>)/";
        } else {
            $regex = "/@yield(\((?:[^)(]+|(?1))*+\))(?![^<>]*<\/title>)/";
        }

        return $regex;
    }

    public function replacementCallback(array $matches): string
    {
        preg_match('/@yield\(\'([^\']+)\'/', $matches[0], $parameters);
        $name = $parameters[1];

        return "<!-- Start section: $name -->{$matches[0]}<!-- End section: $name -->";
    }
}
