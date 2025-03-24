<?php

namespace Spatie\BladeComments;

use Spatie\BladeComments\Commenters\BladeCommenters\BladeCommenter;
use Spatie\BladeComments\Commenters\BladeCommenters\BladeCommenterWithCallback;

class BladeCommentsPrecompiler
{
    public static function execute(string $bladeContent): string
    {
        foreach (self::commenters() as $commenter) {
            if ($commenter instanceof BladeCommenterWithCallback) {
                $bladeContent = preg_replace_callback(
                    $commenter->pattern(),
                    fn (array $matches) => self::insertPrefix($commenter->replacementCallback($matches)),
                    $bladeContent,
                );

                continue;
            }

            $bladeContent = preg_replace(
                $commenter->pattern(),
                self::insertPrefix($commenter->replacement()),
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

    /**
     * Insert our comment prefix
     *
     * @param  null|string  $string
     */
    public static function insertPrefix($string): ?string
    {
        if (! config('blade-comments.prefix')) {
            return $string;
        }

        $prefix = '<!--';
        $string = ltrim($string);

        if (substr($string, 0, strlen($prefix)) == $prefix) {

            $string = '<!-- '.config('blade-comments.prefix').substr($string, strlen($prefix));
        }

        return $string;
    }
}
