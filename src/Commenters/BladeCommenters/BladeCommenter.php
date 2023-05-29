<?php

namespace Spatie\BladePaths\Commenters\BladeCommenters;

interface BladeCommenter
{
    public function pattern(): string;

    public function replacement(): string;
}
