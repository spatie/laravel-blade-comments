<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

interface BladeCommenter
{
    public function pattern(): string;

    public function replacement(): string;
}
