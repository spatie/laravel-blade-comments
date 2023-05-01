<?php

namespace Spatie\BladePaths\Renderers;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;

class BladeIncludeRenderer implements Renderer
{
    public function __construct(protected BladeCompiler $compiler)
    {
    }

    public function register(): void
    {
        Blade::directive('include', function ($expression) {
            $compiledViewContent = invade($this->compiler)->compileInclude($expression);

            $viewPath = trim($expression, "'");

            return $this->render($compiledViewContent, $viewPath);
        });
    }

    protected function render(string $compiledViewContent, string $viewPath): string
    {
        $startComment = "<!-- Start of partial: {$viewPath} -->".PHP_EOL;
        $endComment = PHP_EOL."<!-- End of partial: {$viewPath} -->";

        return "{$startComment}{$compiledViewContent}{$endComment}";
    }
}
