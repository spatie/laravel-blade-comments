<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\DirectiveNode;

class ExtendsCommenter
{
    protected static array $supportedDirectives = [
        'extends',
    ];

    protected string $startComment = '<!-- View :directiveName: :nodeName -->';

    public function __construct(protected array $excludes = [])
    {
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

                $nodeName = $this->getNodeName($directiveNode);

                if ($this->isExcludedByConfig($nodeName)) {
                    continue;
                }

                $directiveNode->sourceContent = $this->addComments($directiveName, $directiveNode, $nodeName);
            }
        }

        return $document->toString();
    }

    private function startComment($directiveName, $name): string
    {
        return strtr($this->startComment, [
            ':directiveName' => $directiveName,
            ':nodeName' => $name,
        ]);
    }

    protected function addComments(string $directiveName, DirectiveNode $directiveNode, string $nodeName): string
    {
        return $this->startComment($directiveName, $nodeName).$directiveNode->toString();
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
