<?php

namespace Spatie\BladePaths\Precompilers;

class BladePathsPrecompiler implements Precompiler
{
    private static $customReplacements = [];

    public static function execute(string $string): string
    {
        $replacements = array_merge(self::replacements(), self::$customReplacements);

        foreach ($replacements as $replacement) {
            $string = preg_replace(
                $replacement['pattern'],
                $replacement['replacement'],
                $string
            );
        }

        return $string;
    }
    public static function addReplacement(string $pattern, string $replacement)
    {
        self::$customReplacements[] = [
            'pattern' => $pattern,
            'replacement' => $replacement,
        ];
    }

    protected static function replacements(): array
    {
        return [
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
                'pattern' => "/@includeIf\([\'\"](.*?)['\"]\)/",
                'replacement' => '<!-- Start Include: $1 -->$0<!-- End Include: $1 -->',
            ],
            [
                'pattern' => "/@includeWhen\([\'\"](.*?)['\"]\)/",
                'replacement' => '<!-- Start Include: $1 -->$0<!-- End Include: $1 -->',
            ],
            [
                'pattern' => "/@livewire\([\'\"](.*?)['\"]\)/",
                'replacement' => '<!-- Start Livewire : $1 -->$0<!-- End Livewire component: $1 -->',
            ],
            [
                'pattern' => "/(<livewire:(\w+)[^>]*\s*\/?>)/",
                'replacement' => '<!-- Start Livewire component: $2 -->$1<!-- End Livewire component: $2 -->',
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
    }
}
