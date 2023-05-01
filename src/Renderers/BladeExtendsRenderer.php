<?php

namespace Spatie\BladePaths\Renderers;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

class BladeExtendsRenderer implements Renderer
{
    public function __construct(protected BladeCompiler $compiler)
    {
    }

    public function register(): void
    {
        Blade::directive('extends', function ($expression) {
            $compiledViewContent = invade($this->compiler)->compileExtends($expression);

            $templatePath = trim($expression, "'");

            return $this->render($compiledViewContent, $templatePath);
        });
    }

    protected function render(string $compiledViewContent, string $templatePath): string
    {
        $startComment = "<!-- Start extends: {$templatePath} -->" . PHP_EOL;

        return "{$startComment}{$compiledViewContent}";
    }
}
