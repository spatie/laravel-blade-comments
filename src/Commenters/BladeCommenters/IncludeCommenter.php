<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;
use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\DirectiveNode;

class IncludeCommenter {

    protected static array $supportedDirectives = [
        'include',
        'includeIf',
        'includeWhen',
        'includeUnless',
        'includeFirst'
    ];

    protected Document $document;

    public function __construct(
        protected array $excludes = []
    ) {
        $this->excludes = config('blade-comments.excludes.includes', []);
    }

    public function parse(string $bladeContent): string
    {
        $document = Document::fromText($bladeContent);

        foreach(self::$supportedDirectives as $directiveName) {

          if (!$document->hasDirective($directiveName)) {
            continue;
          }

          $bladeContent = $document
            ->findDirectivesByName($directiveName)
            ->reject(fn(DirectiveNode $node) => $this->isExcluded($this->getNodeName($node)))
            ->reduce(function (string $content, DirectiveNode $node) use ($directiveName) {
              return $this->addComments(
                  $content,
                  $node,
                  $directiveName,
                  $this->getNodeName($node)
              );
            }, $bladeContent);
        }

        return $bladeContent;
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

    protected function addComments(string $content, DirectiveNode $node, string $directiveName, string $name): string
    {
        $comment = "<!-- Start {$directiveName}: {$name}-->{$node}<!-- End {$directiveName}: {$name}-->";
        return str_replace($node, $comment, $content);
    }

    protected function isExcluded(string $name): bool
    {
        if (empty($this->excludes)) {
            return false;
        }

        $nameWithoutQuotes = str($name)->trim('\'"')->toString();

        return collect($this->excludes)->contains(fn ($exclude) => $nameWithoutQuotes === $exclude);
    }
}
