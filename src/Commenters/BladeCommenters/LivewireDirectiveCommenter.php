<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Livewire\Mechanisms\ComponentRegistry;
use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Document\DocumentOptions;
use Stillat\BladeParser\Nodes\DirectiveNode;

class LivewireDirectiveCommenter
{
    public function parse(string $bladeContent): string
    {
        $options = new DocumentOptions(false, ['livewire']);
        $document = Document::fromText($bladeContent, null, [], $options);

        if (! $document->hasAnyDirectives()) {
            return $bladeContent;
        }

        $registry = app(ComponentRegistry::class);

        $document
            ->getDirectives()
            ->transform(function (DirectiveNode $node) use ($registry) {

                $name = str($node->arguments->getArgValues()->get(0))->trim('\'"')->toString();
                $class = $registry->getClass($name);

                $start = "<!-- Start Livewire component: '{$class}' '{$name}' -->";
                $end = "<!-- End Livewire component: '{$class}' '{$name}' -->";

                $node->sourceContent = $start.$node->toString().$end;

                return $node;
            });

        return $document->toString();
    }
}
