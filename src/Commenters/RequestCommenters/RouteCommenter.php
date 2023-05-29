<?php

namespace Spatie\BladeComments\Commenters\RequestCommenters;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
