<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

use Stillat\BladeParser\Document\Document;
use Stillat\BladeParser\Nodes\DirectiveNode;

class IncludeIfCommenter
{
    public function parse(string $bladeContent): string {
        $document = Document::fromText($bladeContent);

        $excludes = config('blade-comments.excludes.includes', []);

        foreach ($document->findDirectivesByName('includeIf') as $directive) {
            /** @var DirectiveNode $directive */
            $name = $directive->arguments->getArgValues()->get(0);

            if (preg_match('/' .implode('|', $excludes).'/', str($name)->trim("'"))) {
                continue;
            }

            $bladeContent = str_replace($directive->__toString(), "<!-- Start include: $name -->" . $directive->__toString() . "<!-- End include: $name -->", $bladeContent);
        }

        return $bladeContent;
    }
}
