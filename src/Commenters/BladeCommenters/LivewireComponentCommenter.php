<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\Components\ComponentNode;

class LivewireComponentCommenter
{
    public function __construct(protected LivewireClassResolver $resolver) {}

    public function parse(string $bladeContent): string
    {
        $document = Document::fromText($bladeContent, null, ['livewire']);

        if (! $document->hasAnyComponents()) {
            return $bladeContent;
        }

        $document
            ->getComponents()
            ->filter(fn (ComponentNode $node) => $node->componentPrefix == 'livewire')
            ->transform(function (ComponentNode $node) {
                $name = $node->getName();
                $class = $this->resolver->getClass($name);

                $start = "<!-- Start Livewire component: '{$class}' '{$name}' -->";
                $end = "<!-- End Livewire component: '{$class}' '{$name}' -->";

                $node->content = $start.$node->toString().$end;

                return $node;
            });

        return $document->toString();
    }
}
