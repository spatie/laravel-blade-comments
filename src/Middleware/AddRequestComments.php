<?php

namespace Spatie\BladePaths\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Spatie\BladePaths\Middleware\RequestCommenters\RequestCommenter;

class AddRequestComments
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (!$this->shouldAddComments($response)) {
            return $response;
        }

        $newContent = $this->newResponseContent($request, $response);

        $response->setContent($newContent);

        return $response;
    }

    protected function shouldAddComments(Response $response): bool
    {
        if (!Str::contains($response->headers->get('content-type'), 'text/html')) {

            return false;
        }

        if (gettype($response->original) !== 'object') {
            return false;
        }

        return true;
    }

    protected function newResponseContent(Request $request, Response $response): string
    {

        $comments = collect(config('blade-paths.request_commenters'))
            ->map(fn(string $class) => app($class))
            ->map(fn(RequestCommenter $commenter) => $commenter->comment($request, $response))
            ->filter()
            ->implode(PHP_EOL);

        return "{$comments}{$response->getContent()}";
    }


}
