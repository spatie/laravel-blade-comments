<?php

namespace Spatie\BladeComments\Commenters\RequestCommenters;

use Illuminate\Http\Request;
use Illuminate\Http\Response as LaravelResponse;
use Symfony\Component\HttpFoundation\Response;

class ViewCommenter implements RequestCommenter
{
    public function comment(Request $request, Response $response): ?string
    {
        if (! $response instanceof LaravelResponse) {
            return null;
        }

        $viewName = $response->original->name();

        return "<!-- View: {$viewName} -->";
    }
}
