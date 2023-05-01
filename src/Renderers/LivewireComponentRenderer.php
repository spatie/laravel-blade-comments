<?php

namespace Spatie\BladePaths\Renderers;

use Livewire\Livewire;

class LivewireComponentRenderer implements Renderer
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
        $startComment = PHP_EOL."<!-- Start Livewire Component {$componentName} -->".PHP_EOL;
        $endComment = PHP_EOL."<!-- End of Livewire Component {$componentName} -->".PHP_EOL;

        $startPosition = strpos($renderedHtml, '>') + 1;

        $startCommentAndContent = substr_replace($renderedHtml, " {$startComment}", $startPosition, 0);

        return "{$startCommentAndContent}{$endComment}";
    }
}
