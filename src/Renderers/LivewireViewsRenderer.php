<?php

namespace Spatie\BladePaths\Renderers;

use Livewire\Livewire;

class LivewireViewsRenderer implements Renderer
{
    public function register(): void
    {
        if (! class_exists(Livewire::class)) {
            return;
        }

        Livewire::listen('component.dehydrate.initial', function ($component, $response) {
            if (! $renderedHtml = data_get($response, 'effects.html')) {
                return;
            }

            $componentClassName = get_class($component);
            $componentName = "{$componentClassName} ({$component->getName()})";

            $updatedHtml = $this->render($renderedHtml, $componentName);

            data_set($response, 'effects.html', $updatedHtml);
        });
    }

    protected function render(string $renderedHtml, string $componentName): string
    {
        $startComment = "<!-- Start Livewire Component {$componentName} -->";
        $endComment = "<!-- End of Livewire Component {$componentName} -->";

        $startPosition = strpos($renderedHtml, '>') + 1;

        $updatedHtml = substr_replace($renderedHtml, " {$startComment}", $startPosition, 0).$endComment;

        return $updatedHtml;

    }
}
