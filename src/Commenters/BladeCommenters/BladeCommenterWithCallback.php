<?php

namespace Spatie\BladeComments\Commenters\BladeCommenters;

interface BladeCommenterWithCallback
{
    public function pattern(): string;
    public function replacementCallback(array $matches): string;
}
