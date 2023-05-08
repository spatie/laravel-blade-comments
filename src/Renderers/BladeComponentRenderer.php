<?php

namespace Spatie\BladePaths\Renderers;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

class BladeComponentRenderer implements Renderer
{
    public function __construct(protected BladeCompiler $compiler)
    {
    }

    public function register(): void
    {
        Blade::directive('component', function ($expression) {
            $compiledViewContent = invade($this->compiler)->compileComponent($expression);

            return $this->render($compiledViewContent, $expression);
        });
    }

    protected function render(string $compiledViewContent, $expression): string
    {
        $expression = str_replace('\'', '', $expression);
        $expressionParts = explode(', ', $expression);
        $componentName = "{$expressionParts[0]} ({$expressionParts[1]})";

        $startComment = "<!-- Start of component: {$componentName} -->".PHP_EOL;
        $endComment = PHP_EOL."<!-- End of component: {$componentName} -->";

        return "{$startComment}{$compiledViewContent}{$endComment}";
    }
}
