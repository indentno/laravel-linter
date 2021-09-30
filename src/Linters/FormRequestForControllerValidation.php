<?php

namespace S360Digital\LaravelLinter\Linters;

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\FindingVisitor;
use PhpParser\Parser;
use S360Digital\LaravelLinter\Linters\Concerns\LintsControllers;
use Tighten\TLint\BaseLinter;

class FormRequestForControllerValidation extends BaseLinter
{
    use LintsControllers;

    public const description = 'Extract a FormRequest instead of using `$this->validate(...)` or '
        . '`request()->validate(...)` in controllers';

    public function lint(Parser $parser)
    {
        $traverser = new NodeTraverser;

        $visitor = new FindingVisitor(function (Node $node) {
            return $node instanceof Node\Expr\MethodCall
                && $node->var instanceof Node\Expr\Variable
                && $node->var->name === 'this'
                && $node->name->name === 'validate';
        });

        $traverser->addVisitor($visitor);

        $traverser->traverse($parser->parse($this->code));

        return $visitor->getFoundNodes();
    }
}
