<?php

namespace Spatie\BladePaths\Precompilers;

interface Precompiler
{
    public static function execute(string $string): string;
}
