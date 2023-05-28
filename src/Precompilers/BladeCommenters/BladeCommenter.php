<?php

namespace Spatie\BladePaths\Precompilers\BladeCommenters;

interface BladeCommenter
{
    public function pattern(): string;

    public function replacement(): string;
}
