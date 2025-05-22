<?php

namespace Spatie\BladeComments;

use Spatie\BladeComments\Commenters\BladeCommenters\BladeCommenter;
use Spatie\BladeComments\Commenters\BladeCommenters\BladeCommenterWithCallback;

class BladeCommentsPrecompiler
{

    public static function execute(string $bladeContent): string
    {

//        dump($bladeContent); die;

        foreach (self::commenters() as $commenter) {
            $bladeContent = $commenter->parse($bladeContent);


            //            if ($commenter instanceof BladeCommenterWithCallback) {
            //                $bladeContent = preg_replace_callback(
            //                    $commenter->pattern(),
            //                    fn (array $matches) => $commenter->replacementCallback($matches),
            //                    $bladeContent,
            //                );
            //
            //                continue;
            //            }

            //            $bladeContent = preg_replace(
            //                $commenter->pattern(),
            //                $commenter->replacement(),
            //                $bladeContent,
            //            );
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
