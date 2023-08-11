<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class IncludeIfCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        $blacklistRegex = '';
        $blackListItems = config('blade-comments.blacklist.includes', []);

        if (count($blackListItems)) {
            $blacklistRegex = '(?!' . implode('|', $blackListItems) . ')';
        }

        return "/@includeIf\([\'\"]{$blacklistRegex}(.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- Start includeIf: $1 -->$0<!-- End includeIf: $1 -->';
    }
}
