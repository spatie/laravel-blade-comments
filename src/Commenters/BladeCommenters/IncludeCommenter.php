<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class IncludeCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        $blacklistRegex = '';
        $blackListItems = config('blade-comments.blacklist.includes', []);

        if (count($blackListItems)) {
            $blacklistRegex = '(?!' . implode('|', $blackListItems) . ')';
        }

        return "/@include\([\'\"]{$blacklistRegex}(.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- Start include: $1 -->$0<!-- End include: $1 -->';
    }
}
