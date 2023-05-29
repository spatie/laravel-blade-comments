<?php

namespace Spatie\BladePaths\Precompilers;

use Spatie\BladePaths\Commenters\BladeCommenters\BladeCommenter;

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
        return collect(config('blade-paths.blade_commenters'))
            ->map(fn (string $class) => app($class))
            ->toArray();
    }
}
