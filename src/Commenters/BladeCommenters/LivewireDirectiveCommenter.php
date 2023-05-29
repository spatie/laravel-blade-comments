<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

class LivewireDirectiveCommenter implements BladeCommenter
{
    public function pattern(): string
    {
        return "/@livewire\([\'\"](.*?)['\"]\)/";
    }

    public function replacement(): string
    {
        return '<!-- Start Livewire : $1 -->$0<!-- End Livewire component: $1 -->';
    }
}
