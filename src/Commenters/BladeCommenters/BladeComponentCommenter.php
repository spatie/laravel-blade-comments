<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\Components\ComponentNode;

class BladeComponentCommenter
{

    protected string $startComment = '<!-- Start :directive :path :name -->';

    protected string $endComment = '<!-- End :directive :path :name -->';

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
        $path = app('blade.compiler')->getClassComponentAliases()[$name] ?? '';

        return strtr(($part === 'start' ? $this->startComment : $this->endComment), [
            ':directive' => $directive,
            ':path' => str($path)->wrap("'"),
            ':name' => str($name)->wrap("'"),
        ]);
    }

    public function addComments(ComponentNode $node): string
    {
        return $this->htmlComment($node, 'start') . $node->toString() . $this->htmlComment($node, 'end');
    }

}
