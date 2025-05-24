<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\DirectiveNode;

class IncludeCommenter
{
    protected static array $supportedDirectives = [
        'include',
        'includeIf',
        'includeWhen',
        'includeUnless',
        'includeFirst',
    ];

    protected string $startComment = '<!-- Start :directive: :name -->';

    protected string $endComment = '<!-- End :directive: :name -->';

    public function __construct(protected array $excludes = []) {
        $this->excludes = config('blade-comments.excludes.includes', []);
    }

    public function parse(string $bladeContent): string
    {
        $document = Document::fromText($bladeContent);

        foreach (self::$supportedDirectives as $directiveName) {

            if (! $document->hasDirective($directiveName)) {
                continue;
            }

            $document->findDirectivesByName($directiveName)
                ->filter(fn (DirectiveNode $node) => !$this->isExcludedByConfig($this->getNodeName($node)))
                ->transform(function (DirectiveNode $node) use ($directiveName) {
                    $node->sourceContent = $this->addComments($node, $directiveName);
                    return $node;
                });
        }

        return $document->toString();
    }

    /**
     * If the directive is: @include('example', [])
     *
     * This will return 'example'
     */
    protected function getNodeName(DirectiveNode $node): string
    {
        return $node->arguments->getArgValues()->get(0);
    }

    protected function htmlComment(DirectiveNode $node, string $directiveName, string $part = 'start'): string
    {
        return strtr(($part === 'start' ? $this->startComment : $this->endComment), [
            ':directive' => $directiveName,
            ':name' => $this->getNodeName($node),
        ]);
    }

    protected function addComments(DirectiveNode $node, $directiveName): string
    {
        return $this->htmlComment($node, $directiveName, 'start').$node->toString().$this->htmlComment($node, $directiveName, 'end');
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
