<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class IncludeUnlessCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        $blacklistRegex = '';
        $blackListItems = config('blade-comments.blacklist.includes', []);

        if (count($blackListItems)) {
            $blacklistRegex = '(?!' . implode('|', $blackListItems) . ')';
        }

        return '/(?:^|\n)(\s*)@includeUnless\(([^)]+),\s*[\'"]' . $blacklistRegex . '([^\'"]*)[\'"]\)/';
    }

    public function replacement(): string
    {
        return '<!-- Start includeUnless: $3 --> $0<!-- End includeUnless: $3 -->';
    }
}
