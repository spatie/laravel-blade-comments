<?php

namespace Spatie\BladePaths\Middleware\RequestCommenters;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RouteCommenter implements RequestCommenter
{
    public function comment(Request $request, Response $response): ?string
    {
        $comment = '';

        $routeAction = $request->route()->getAction();

        if (! isset($routeAction['controller'])) {
            return null;
        }

        $route = $routeAction['controller'];

        $comment .= "<!-- Route: {$route} ";

        if (isset($routeAction['as'])) {
            $comment .= "({$routeAction['as']}) ";
        }

        $comment .= '-->';

        return $comment;
    }
}
