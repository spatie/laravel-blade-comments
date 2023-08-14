<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class IncludeUnlessCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        $excludeRegex = '';
        $excludes = config('blade-comments.excludes.includes', []);

        if (count($excludes)) {
            $excludeRegex = '(?!'.implode('|', $excludes).')';
        }

        return '/(?:^|\n)(\s*)@includeUnless\(([^)]+),\s*[\'"]'.$excludeRegex.'([^\'"]*)[\'"]\)/';
    }

    public function replacement(): string
    {
        return '<!-- Start includeUnless: $3 --> $0<!-- End includeUnless: $3 -->';
    }
}
