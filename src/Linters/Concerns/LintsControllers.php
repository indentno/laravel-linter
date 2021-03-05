<?php

namespace S360Digital\LaravelLinter\Linters\Concerns;

trait LintsControllers
{
    public static function appliesToPath(string $path): bool
    {
        return strpos($path, 'Http/Controllers') !== false;
    }
}
