<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class IncludeWhenCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        $blacklistRegex = '';
        $blackListItems = config('blade-comments.blacklist.includes', []);

        if (count($blackListItems)) {
            $blacklistRegex = '(?!'.implode('|', $blackListItems).')';
        }

        return '/(?:^|\n)(\s*)@includeWhen\(([^)]+),\s*[\'"]'.$blacklistRegex.'([^\'"]*)[\'"]\)/';
    }

    public function replacement(): string
    {
        return '<!-- Start includeWhen: $3 --> $0<!-- End includeWhen: $3 -->';
    }
}
