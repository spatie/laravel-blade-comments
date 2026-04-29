<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Livewire\Mechanisms\ComponentRegistry;

class LivewireClassResolver
{
    public function getClass(string $name): ?string
    {
        if (class_exists(ComponentRegistry::class)) {
            return app(ComponentRegistry::class)->getClass($name);
        }

        if (app()->bound('livewire.factory')) {
            return app('livewire.factory')->resolveComponentClass($name);
        }

        return null;
    }
}
