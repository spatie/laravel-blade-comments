<?php

namespace Spatie\BladePaths\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AddCurrentViewComment
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! Str::contains($response->headers->get('content-type'), 'text/html')) {
            return $response;
        }

        $viewName = $response->original->name();

        $response->setContent(
            $this->getViewComment($viewName) .
            $this->getRouteComment($request) .
            $response->getContent()
        );

        return $response;
    }

    protected function getViewComment(string $templatePath): string
    {
        return "<!-- View: {$templatePath} -->".PHP_EOL;
    }

    protected function getRouteComment(Request $request): string
    {
        $comment = '';
        $routeAction = $request->route()->getAction();

        if (!isset($routeAction['controller'])) {
            return $comment;
        }

        $route = $routeAction['controller'];
        $comment .= "<!-- Route: {$route} ";

        if (isset($routeAction['as'])) {
            $comment .= "({$routeAction['as']}) ";
        }

        $comment .= "-->".PHP_EOL;

        return $comment;
    }
}
