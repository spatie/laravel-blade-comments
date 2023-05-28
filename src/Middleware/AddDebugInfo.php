<?php

namespace Spatie\BladePaths\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class AddDebugInfo
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! $this->shouldAddViewComment($response)) {
            return $response;
        }

        $newContent = $this->newResponseContent($request, $response);

        $response->setContent($newContent);

        return $response;
    }

    protected function shouldAddViewComment(Response $response): bool
    {
        if (! Str::contains($response->headers->get('content-type'), 'text/html')) {

            return false;
        }

        if (gettype($response->original) !== 'object') {
            return false;
        }

        return true;
    }

    private function newResponseContent(Request $request, mixed $response): string
    {
        $viewName = $response->original->name();

        $viewComment = $this->getViewComment($viewName);

        $routeComment = $this->getRouteComment($request);

        $originalResponseContent = $response->getContent();

        return "{$viewComment}{$routeComment}{$originalResponseContent}";
    }

    protected function getViewComment(string $templatePath): string
    {
        return "<!-- View: {$templatePath} -->".PHP_EOL;
    }

    protected function getRouteComment(Request $request): string
    {
        $comment = '';
        $routeAction = $request->route()->getAction();

        if (! isset($routeAction['controller'])) {
            return $comment;
        }

        $route = $routeAction['controller'];

        $comment .= "<!-- Route: {$route} ";

        if (isset($routeAction['as'])) {
            $comment .= "({$routeAction['as']}) ";
        }

        $comment .= '-->'.PHP_EOL;

        return $comment;
    }
}
