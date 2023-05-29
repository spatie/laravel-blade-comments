<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class ExtendsCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/@extends\([\'\"](.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- View extends: $1 -->$0';
    }
}
