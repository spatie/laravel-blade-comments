<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class IncludeIfCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        $excludesRegex = '';
        $excludes = config('blade-comments.excludes.includes', []);

        if (count($excludes)) {
            $excludesRegex = '(?!'.implode('|', $excludes).')';
        }

        return "/@includeIf\((?<q>[\'\"]){$excludesRegex}(.*?)\k<q>(,(.*))?\)/s";
    }

    public function replacement(): string
    {
        return '<!-- Start includeIf: $2 -->$0<!-- End includeIf: $2 -->';
    }
}
