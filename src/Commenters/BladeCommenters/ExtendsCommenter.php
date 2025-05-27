<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\DirectiveNode;

class ExtendsCommenter
{
    protected string $startComment = '<!-- Start extends: :name -->';

    public function __construct(protected array $excludes = [])
    {
        $this->excludes = config('blade-comments.excludes.sections', []);
    }

    public function parse(string $bladeContent): string
    {
        $document = Document::fromText($bladeContent);
        $directive = 'extends';

        if (! $document->hasDirective($directive)) {
            return $bladeContent;
        }

        $document->findDirectivesByName($directive)
            ->filter(fn (DirectiveNode $node) => ! $this->isExcludedByConfig($this->getNodeName($node)))
            ->transform(function (DirectiveNode $node) {
                $node->sourceContent = $this->htmlComment($node).$node->toString();

                return $node;
            });

        return $document->toString();
    }

    protected function htmlComment(DirectiveNode $node): string
    {
        return strtr($this->startComment, [':name' => $this->getNodeName($node) ]);
    }

    /**
     * If the directive is: @yield('example', [])
     *
     * This will return 'example'
     */
    protected function getNodeName(DirectiveNode $directiveNode): string
    {
        return $directiveNode->arguments->getArgValues()->get(0);
    }

    protected function isExcludedByConfig(string $name): bool
    {
        if (empty($this->excludes)) {
            return false;
        }

        $nameWithoutQuotes = str($name)->trim('\'"')->toString();

        return collect($this->excludes)->contains(fn ($exclude) => $nameWithoutQuotes === $exclude);
    }
}
