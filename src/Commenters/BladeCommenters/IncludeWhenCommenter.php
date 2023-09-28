<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class IncludeWhenCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        $excludesRegex = '';
        $excludes = config('blade-comments.excludes.includes', []);

        if (count($excludes)) {
            $excludesRegex = '(?!'.implode('|', $excludes).')';
        }

        return '/(?:^|\n|\r\n)(\s*)@includeWhen\(([^)]+),\s*[\'"]'.$excludesRegex.'([^\'"]*)[\'"]\)/';
    }

    public function replacement(): string
    {
        return '<!-- Start includeWhen: $3 --> $0<!-- End includeWhen: $3 -->';
    }
}
