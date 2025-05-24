<?php

namespace Spatie\BladeComments;

class BladeCommentsPrecompiler
{
    public static function execute(string $bladeContent): string
    {
        foreach (self::commenters() as $commenter) {
            $bladeContent = $commenter->parse($bladeContent);
        }

        return $bladeContent;
    }

    protected static function commenters(): array
    {
        return collect(config('blade-comments.blade_commenters'))
            ->map(fn (string $class) => app($class))
            ->toArray();
    }
}
