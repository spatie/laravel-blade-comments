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

        return "/@include\([\'\"]{$excludesRegex}(.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- Start include: $1 -->$0<!-- End include: $1 -->';
    }
}
