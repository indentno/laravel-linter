<?php

namespace Indent\LaravelLinter\Linters;

use Closure;
use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Identifier;
use Tighten\TLint\BaseLinter;

class NoDump extends BaseLinter
{
    public const DESCRIPTION = 'There should be no calls to `dd()`, `dump()`, `ray()`, or `var_dump()`';

    protected function visitor(): Closure
    {
        return function (Node $node) {
            return ($node instanceof FuncCall && ! empty($node->name->getParts()) && in_array($node->name->getParts()[0], ['dd', 'dump', 'var_dump', 'ray'], true))
                || ($node instanceof Identifier && in_array($node->name, ['dump', 'dd'], true));
        };
    }
}
