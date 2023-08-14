<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class IncludeIfCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        $excludeRegex = '';
        $excludes = config('blade-comments.excludes.includes', []);

        if (count($excludes)) {
            $excludeRegex = '(?!'.implode('|', $excludes).')';
        }

        return "/@includeIf\([\'\"]{$excludeRegex}(.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- Start includeIf: $1 -->$0<!-- End includeIf: $1 -->';
    }
}
