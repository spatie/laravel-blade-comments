<?php

namespace Spatie\BladePaths\Concerns;

trait GetsPathFromDirectiveExpression
{
    public function getPath(string $expression): string
    {
        return trim($expression, "'");
    }
}
