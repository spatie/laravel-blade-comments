<?php

namespace Spatie\BladePaths\Renderers;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Spatie\BladePaths\Concerns\GetsPathFromDirectiveExpression;

class BladeIncludeRenderer implements Renderer
{
    use GetsPathFromDirectiveExpression;

    public function __construct(protected BladeCompiler $compiler)
    {
    }

    public function register(): void
    {
        $this->registerInclude();
        $this->registerIncludeIf();
        $this->registerIncludeWhen();
        $this->registerIncludeUnless();
    }

    protected function registerInclude(): void
    {
        Blade::directive('include', function ($expression) {
            $compiledViewContent = invade($this->compiler)->compileInclude($expression);

            return $this->render($compiledViewContent, $this->getPath($expression));
        });
    }

    protected function registerIncludeIf(): void
    {
        Blade::directive('includeIf', function ($expression) {
            $compiledViewContent = invade($this->compiler)->compileIncludeIf($expression);

            return $this->render($compiledViewContent, $this->getPath($expression));
        });
    }

    protected function registerIncludeWhen(): void
    {
        Blade::directive('includeWhen', function ($expression) {
            $compiledViewContent = invade($this->compiler)->compileIncludeWhen($expression);

            return $this->render($compiledViewContent, $this->getPath($expression));
        });
    }

    protected function registerIncludeUnless(): void
    {
        Blade::directive('includeUnless', function ($expression) {
            $compiledViewContent = invade($this->compiler)->compileIncludeUnless($expression);

            return $this->render($compiledViewContent, $this->getPath($expression));
        });
    }

    protected function render(string $compiledViewContent, string $viewPath): string
    {
        $startComment = "<!-- Start of partial: {$viewPath} -->".PHP_EOL;
        $endComment = PHP_EOL."<!-- End of partial: {$viewPath} -->";

        return "{$startComment}{$compiledViewContent}{$endComment}";
    }
}
