<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\Components\ComponentNode;

class BladeComponentCommenter
{
    protected string $startComment = '<!-- Start :directive :class :name -->';

    protected string $endComment = '<!-- End :directive :class :name -->';

    public function parse(string $bladeContent): string
    {
        $document = Document::fromText($bladeContent);

        if (! $document->hasAnyComponents()) {
            return $bladeContent;
        }

        $document
            ->getComponents()
            ->transform(function (ComponentNode $node) {
                $node->content = $this->addComments($node);

                return $node;
            });

        return $document->toString();
    }

    private function htmlComment(ComponentNode $node, string $part = 'start'): string
    {
        $directive = 'component';
        $name = $node->getName();
        $class = app('blade.compiler')->getClassComponentAliases()[$name] ?? '';

        return strtr(($part === 'start' ? $this->startComment : $this->endComment), [
            ':directive' => $directive,
            ':path' => str($class)->wrap("'"),
            ':name' => str($class)->wrap("'"),
        ]);
    }

    public function addComments(ComponentNode $node): string
    {
        return $this->htmlComment($node, 'start').$node->toString().$this->htmlComment($node, 'end');
    }
}
