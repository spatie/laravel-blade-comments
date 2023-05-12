<?php

namespace Spatie\BladePaths\Renderers;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Spatie\BladePaths\Concerns\GetsPathFromDirectiveExpression;

class BladeExtendsRenderer implements Renderer
{
    use GetsPathFromDirectiveExpression;

    public function __construct(protected BladeCompiler $compiler)
    {
    }

    public function register(): void
    {
        Blade::directive('extends', function ($expression) {
            $compiledViewContent = invade($this->compiler)->compileExtends($expression);

            return $this->render($compiledViewContent, $this->getPath($expression));
        });
    }

    protected function render(string $compiledViewContent, string $templatePath): string
    {
        $startComment = "<!-- View extends: {$templatePath} -->".PHP_EOL;

        return "{$startComment}{$compiledViewContent}";
    }
}
