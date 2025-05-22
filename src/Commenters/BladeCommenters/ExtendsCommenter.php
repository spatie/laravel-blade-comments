<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\DirectiveNode;

class ExtendsCommenter
{
    protected static array $supportedDirectives = [
        'extends',
    ];

    protected string $startComment = '<!-- View start: :name -->';

    protected string $endComment = '<!-- View end: :name -->';

    public function __construct(protected array $excludes = [])
    {
        $this->excludes = config('blade-comments.excludes.sections', []);
    }

    public function parse(string $bladeContent): string
    {
        /** @var DirectiveNode $node */
        $document = Document::fromText($bladeContent);

        foreach (self::$supportedDirectives as $directiveName) {

            if (! $document->hasDirective($directiveName)) {
                continue;
            }

            foreach ($document->findDirectivesByName($directiveName) as &$node) {

                $nodeName = $this->getNodeName($node);

                if ($this->isExcludedByConfig($nodeName)) {
                    continue;
                }

                $node->sourceContent = $this->addComments($node);
            }
        }

        return $document->toString();
    }

    private function htmlComment(DirectiveNode $node, string $part): string
    {
        return strtr(($part === 'start' ? $this->startComment : $this->endComment), [
            ':name' => $this->getNodeName($node),
        ]);
    }

    public function addComments(DirectiveNode $node): string
    {
        return $this->htmlComment($node, 'start') . $node->toString();
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
