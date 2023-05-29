<?php

namespace Spatie\BladeComments;

use Spatie\BladeComments\Commenters\BladeCommenters\BladeCommenter;
use Spatie\BladeComments\Precompilers\Precompiler;

class BladeCommentsPrecompiler
{
    public static function execute(string $string): string
    {
        foreach (self::commenters() as $commenter) {
            $string = preg_replace(
                $commenter->pattern(),
                $commenter->replacement(),
                $string,
            );
        }

        return $string;
    }

    /**
     * @return array<BladeCommenter>
     */
    protected static function commenters(): array
    {
        return collect(config('blade-comments.blade_commenters'))
            ->map(fn (string $class) => app($class))
            ->toArray();
    }
}
