<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Livewire\Mechanisms\ComponentRegistry;
use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\Components\ComponentNode;

class LivewireComponentCommenter
{
    public function parse(string $bladeContent): string
    {
        $document = Document::fromText($bladeContent, null, ['livewire']);

        if (! $document->hasAnyComponents()) {
            return $bladeContent;
        }

        $registry = app(ComponentRegistry::class);

        $document
            ->getComponents()
            ->filter(fn (ComponentNode $node) => $node->componentPrefix == 'livewire')
            ->transform(function (ComponentNode $node) use ($registry) {

                $name = $node->getName();
                $class = $registry->getClass($name);

                $start = "<!-- Start Livewire component: '{$class}' '{$name}' -->";
                $end = "<!-- End Livewire component: '{$class}' '{$name}' -->";

                $node->content = $start.$node->toString().$end;

                return $node;
            });

        return $document->toString();
    }
}
