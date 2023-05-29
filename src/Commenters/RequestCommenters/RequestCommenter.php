<?php

namespace Spatie\BladeComments\Commenters\RequestCommenters;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

interface RequestCommenter
{
    public function comment(Request $request, Response $response): ?string;
}
