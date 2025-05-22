<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Illuminate\Support\Str;
use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\DirectiveNode;
use Stillat\BladeParser\Nodes\LiteralNode;

class SectionCommenter
{
    protected static array $supportedDirectives = [
        'yield',
    ];

    protected string $startComment = '<!-- Start section: :name -->';

    protected string $endComment = '<!-- End section: :name -->';

    public function __construct(
        protected array $excludes = []
    ) {
        $this->excludes = config('blade-comments.excludes.sections', []);
    }

    public function parse(string $bladeContent): string
    {
        /** @var DirectiveNode $directiveNode */
        $document = Document::fromText($bladeContent);

        foreach (self::$supportedDirectives as $directiveName) {

            if (! $document->hasDirective($directiveName)) {
                continue;
            }

            foreach ($document->findDirectivesByName($directiveName) as &$directiveNode) {

                $name = $this->getNodeName($directiveNode);

                if ($this->isExcludedByConfig($name)) {
                    continue;
                }

                $directiveNode->sourceContent = $this->addComments($directiveNode, $name);
            }
        }

        return $document->toString();
    }

    private function startComment($name): string
    {
        return Str::replace(':name', $name, $this->startComment);
    }

    private function endComment($name): string
    {
        return Str::replace(':name', $name, $this->endComment);
    }

    protected function addComments(DirectiveNode $directiveNode, string $name): string
    {
        // Do not add comments if it is part of the <title> tag
        if ($directiveNode->getNextNode() instanceof LiteralNode
            && preg_match('/^\s*<\/title>/', $directiveNode->getNextNode())
        ) {
            return $directiveNode->toString();
        }

        return $this->startComment($name).$directiveNode->toString().$this->endComment($name);
    }

    /**
     * If the directive is: @yield('example', [])
     *
     * This will return 'example'
     */
    protected function getNodeName(DirectiveNode $node): string
    {
        return $node->arguments->getArgValues()->get(0);
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
