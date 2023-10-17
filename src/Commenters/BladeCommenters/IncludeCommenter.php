<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class IncludeCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        $excludesRegex = '';
        $excludes = config('blade-comments.excludes.includes', []);

        if (count($excludes)) {
            $excludesRegex = '(?!'.implode('|', $excludes).')';
        }

        return "/@include\((?<q>[\'\"]){$excludesRegex}(.*?)\k<q>(,(.*))?\)/s";
    }

    public function replacement(): string
    {
        return '<!-- Start include: $2 -->$0<!-- End include: $2 -->';
    }
}
