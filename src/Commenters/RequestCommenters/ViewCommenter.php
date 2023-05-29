<?php

namespace Spatie\BladeComments\Commenters\RequestCommenters;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ViewCommenter implements RequestCommenter
{
    public function comment(Request $request, Response $response): ?string
    {
        $viewName = $response->original->name();

        return "<!-- View: {$viewName} -->";
    }
}
