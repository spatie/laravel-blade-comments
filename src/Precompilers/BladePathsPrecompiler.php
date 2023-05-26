<?php

namespace Spatie\BladePaths\Precompilers;

class BladePathsPrecompiler implements Precompiler
{
    public static function execute(string $string): string
    {
        $replacements = [
            [
                'pattern' => "/@extends\([\'\"](.*?)['\"]\)/",
                'replacement' => '<!-- View Extends: $1 -->$0',
            ],
            [
                'pattern' => "/@section\([\'\"](.*?)['\"]\)/",
                'replacement' => '<!-- Start Section: $1 -->$0',
            ],
            [
                'pattern' => "/@include\([\'\"](.*?)['\"]\)/",
                'replacement' => '<!-- Start Include: $1 -->$0<!-- End Include: $1 -->',
            ],
            [
                'pattern' => "/@livewire\([\'\"](.*?)['\"]\)/",
                'replacement' => '<!-- Start Livewire: $1 -->$0<!-- End Livewire: $1 -->',
            ],
            [
                'pattern' => "/@component\([\'\"](.*?)[\'\"].*?\)/",
                'replacement' => '<!-- Blade Component: $1 -->$0',
            ],
            [
                'pattern' => '/@(endComponentClass|endcomponent)/',
                'replacement' => '$0<!-- End Blade Component -->',
            ],
        ];

        foreach ($replacements as $replacement) {
            $string = preg_replace($replacement['pattern'], $replacement['replacement'], $string);
        }

        return $string;
    }
}
