<?php

namespace S360Digital\LaravelLinter\Linters;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\FindingVisitor;
use PhpParser\Parser;
use S360Digital\LaravelLinter\Linters\Concerns\LintsControllers;
use Tighten\TLint\BaseLinter;

class NoCompact extends BaseLinter
{
    use LintsControllers;

    public const DESCRIPTION = 'There should be no calls to `compact()` in controllers';

    public function lint(Parser $parser)
    {
        $traverser = new NodeTraverser;

        $visitor = new FindingVisitor(function (Node $node) {
            return $node instanceof FuncCall && ! empty($node->name->parts) && $node->name->parts[0] === 'compact';
        });

        $traverser->addVisitor($visitor);

        $traverser->traverse($parser->parse($this->code));

        return $visitor->getFoundNodes();
    }
}
