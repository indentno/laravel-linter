<?php

namespace Indent\LaravelLinter\Linters;

use Closure;
use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use Tighten\TLint\BaseLinter;
use Tighten\TLint\Linters\Concerns\LintsControllers;

class NoCompact extends BaseLinter
{
    use LintsControllers;

    public const DESCRIPTION = 'There should be no calls to `compact()` in controllers';

    protected function visitor(): Closure
    {
        return function (Node $node) {
            return $node instanceof FuncCall
                && !empty($node->name->getParts())
                && $node->name->getParts()[0] === 'compact';
        };
    }
}
