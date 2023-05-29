<?php

namespace Spatie\BladePaths\Commenters\BladeCommenters;

class IncludeWhenCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return '/(?:^|\n)(\s*)@includeWhen\(([^)]+),\s*[\'"]([^\'"]*)[\'"]\)/';
    }

    public function replacement(): string
    {
        return '<!-- Start includeWhen: $3 --> $0<!-- End includeWhen: $3 -->';
    }
}
