<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Illuminate\View\Compilers\ComponentTagCompiler;
use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\Components\ComponentNode;
use Stillat\BladeParser\Nodes\Components\ParameterNode;

class BladeComponentCommenter
{
    public function __construct()
    {
        $compiler = app('blade.compiler');
        $this->tagCompiler = new ComponentTagCompiler(
            $compiler->getClassComponentAliases(),
            $compiler->getClassComponentNamespaces(),
            $compiler
        );
    }

    public function parse(string $bladeContent): string
    {
        $document = Document::fromText($bladeContent);

        if (! $document->hasAnyComponents()) {
            return $bladeContent;
        }

        $document
            ->getComponents()
            ->transform(function (ComponentNode $node) {
                // For components blade parser doesn't keep track of the corresponding opening and closing tags
                // The property isClosedBy and openedBy are not set (always null).

                if ($node->isSelfClosing || ! $node->isClosingTag) {
                    $start = $this->htmlComment($node, 'start');
                    $node->content = $start.$node->toString();
                }

                if ($node->isSelfClosing || $node->isClosingTag) {
                    $end = $this->htmlComment($node, 'end');
                    $node->content = $node->content.$end;
                }

                return $node;
            });

        return $document->toString();
    }

    protected function htmlComment(ComponentNode $node, string $part = 'start'): string
    {
        $parts = [];
        $id = $node->getTagName();

        try {
            $parts[] = $this->tagCompiler->componentClass($id);
        } catch (\Exception $e) {
            // Silent fail
        }

        $name = $node->getName();
        if ($name instanceof ParameterNode) {
            $id .= ' - '.$name->value;
        }

        $parts[] = $id;
        $action = $part === 'start' ? 'Start' : 'End';

        return "<!-- $action component: '".implode("' '", $parts)."' -->";
    }
}
