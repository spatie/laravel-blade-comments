<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Document\DocumentOptions;
use Stillat\BladeParser\Nodes\DirectiveNode;

class LivewireDirectiveCommenter
{
    public function __construct(protected LivewireClassResolver $resolver) {}

    public function parse(string $bladeContent): string
    {
        // Add custom directive
        $options = new DocumentOptions(false, ['livewire']);
        $document = Document::fromText($bladeContent, null, [], $options);

        if (! $document->hasAnyDirectives()) {
            return $bladeContent;
        }

        $document
            ->getDirectives()
            ->transform(function (DirectiveNode $node) {
                $name = str($node->arguments->getArgValues()->get(0))->trim('\'"')->toString();
                $class = $this->resolver->getClass($name);

                $start = "<!-- Start Livewire component: '{$class}' '{$name}' -->";
                $end = "<!-- End Livewire component: '{$class}' '{$name}' -->";

                $node->sourceContent = $start.$node->toString().$end;

                return $node;
            });

        return $document->toString();
    }
}
