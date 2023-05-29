<?php

namespace Spatie\BladeComments\Precompilers;

use Spatie\BladeComments\Commenters\BladeCommenters\BladeCommenter;

class BladeCommentsPrecompiler implements Precompiler
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
