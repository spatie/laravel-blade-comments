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

        $componentCollections = $document->getComponents();

        foreach ($componentCollections as &$node) {
            /** @var ComponentNode $node */
            $node->content = $this->addComments($node);
        }
        return $document->toString();
    }


    // todo find path?
    private function htmlComment(ComponentNode $node, string $part = 'start'): string
    {
        $directive = 'component';
//        $path = '';
        $name = $node->getName();

        return strtr(($part === 'start' ? $this->startComment : $this->endComment), [
            ':directive' => $directive,
//            ':path' => $path,
            ':name' => $name,
        ]);
    }

    public function addComments(ComponentNode $node): string
    {
        return $this->htmlComment($node, 'start') . $node->toString() . $this->htmlComment($node, 'end');
    }

}



//<?php
//
//namespace Spatie\BladeComments\Commenters\BladeCommenters;
//
//use Stillat\BladeParser\Document\Document;
//use Stillat\BladeParser\Nodes\Components\ComponentNode;
//use Stillat\BladeParser\Nodes\DirectiveNode;
//
//class BladeComponentCommenter
//{
//
//    protected string $startComment = '<!-- Start :directive :path :name -->';
//
//    protected string $endComment = '<!-- End :directive :path :name -->';
//
//    public function parse($bladeContent): string
//    {
//        $document = Document::fromText($bladeContent);
//
//        $componentCollections = $document->getComponents();
//
//        foreach ($componentCollections as &$node) {
//
//            /** @var ComponentNode $node */
//dump($this->addComments($node));
//            $node->sourceContent = $this->addComments($node);
//
//        }
//        return $document->toString();
//    }
//
//
////    ##############################################################
//
////    public function parse($bladeContent): string
////    {
////        $document = Document::fromText($bladeContent);
////
////        $componentCollections = $document->findDirectivesByName('component');
////
////        foreach ($componentCollections as &$node) {
////
////            /** @var DirectiveNode $node */
////
////            $node->sourceContent = $this->addComments($node);
////
////        }
////        return $document->toString();
////    }
////
//    private function htmlComment(ComponentNode $node, string $part = 'start'): string
//    {
//        $directive = 'component';
//        $path = 'pad';
//        $name = $node->getName();
//
//        return strtr(($part === 'start' ? $this->startComment : $this->endComment), [
//            ':directive' => $directive,
//            ':path' => $path,
//            ':name' => $name,
//        ]);
//    }
////
//    public function addComments(ComponentNode $node): string
//    {
//        return $this->htmlComment($node, 'start') . $node->toString() . $this->htmlComment($node, 'end');
//    }
////
////
////    /**
////     * For Example: 'Spatie\BladeComments\Tests\TestSupport\BladeComponents\TestBladeComponent'
////     */
////    protected function getNodePath(DirectiveNode $node): string
////    {
////        return $node->arguments->getArgValues()->get(0);
////    }
////
////
////    /**
////     * For Example: 'test-component'
////     */
////    protected function getNodeName(DirectiveNode $node): string
////    {
////        return $node->arguments->getArgValues()->get(1);
////    }
//
//
//
////    public function pattern(): string
////    {
////        return '/##BEGIN-COMPONENT-CLASS##@component\(\\\'([^\']+)\\\', *\\\'([^\']+)\\\', *(\[[^\]]*\])\)(.*?)@endComponentClass##END-COMPONENT-CLASS##/s';
////    }
////
////    public function replacement(): string
////    {
////        return '<!-- Start component \'$1\' \'$2\' -->$0<!-- End component \'$1\' \'$2\' -->';
////    }
//}
