<?php

namespace Spatie\BladePaths\Commenters\BladeCommenters;

class LivewireComponentCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/(<livewire:(\w+)[^>]*\s*\/?>)/";
    }

    public function replacement(): string
    {
        return '<!-- Start Livewire component: $2 -->$1<!-- End Livewire component: $2 -->';
    }
}
