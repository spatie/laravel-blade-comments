<?php

namespace Spatie\BladeComments;

use Illuminate\Support\Str;

class BladeCommentsPrecompiler
{
    public static function execute(string $bladeContent): string
    {
        $path = null;

        if (config('blade-comments.blade_paths')) {
            $compiler = app('blade.compiler');
            $path = rescue(fn () => Str::after($compiler->getPath(), base_path(DIRECTORY_SEPARATOR)), null);
        }

        if ($path) {
            $bladeContent = "\n<!-- Start blade view: $path -->\n" . $bladeContent;
        }

        foreach (self::commenters() as $commenter) {
            $bladeContent = $commenter->parse($bladeContent);
        }

        if ($path) {
            return $bladeContent . "\n<!-- End blade view: $path -->\n";
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
