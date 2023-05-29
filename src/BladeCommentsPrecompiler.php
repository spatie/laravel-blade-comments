<?php

namespace Spatie\BladeComments;

use Spatie\BladeComments\Commenters\BladeCommenters\BladeCommenter;

class BladeCommentsPrecompiler
{
    public static function execute(string $bladeContent): string
    {
        foreach (self::commenters() as $commenter) {
            $bladeContent = preg_replace(
                $commenter->pattern(),
                $commenter->replacement(),
                $bladeContent,
            );
        }

        return $bladeContent;
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
