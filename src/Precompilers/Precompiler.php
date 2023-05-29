<?php

namespace Spatie\BladeComments\Precompilers;

interface Precompiler
{
    public static function execute(string $string): string;
}
