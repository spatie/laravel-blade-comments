<?php

namespace Spatie\BladePaths\Exceptions;

use Exception;

class InvalidRenderer extends Exception
{
    public static function make(string $className): self
    {
        return new self("`{$className}` is not a valid renderer. A valid rendered must implement `Spatie\BladePaths\Renderers\Renderer`");
    }
}
