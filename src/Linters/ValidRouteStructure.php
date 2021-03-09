<?php

namespace S360Digital\LaravelLinter\Linters;

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\FindingVisitor;
use PhpParser\Parser;
use Tighten\BaseLinter;
use Tighten\Linters\Concerns\LintsRoutesFiles;

class ValidRouteStructure extends BaseLinter
{
    use LintsRoutesFiles;

    public const description = 'Routes should be structured correctly. More information '
        . 'here: https://docs.sempro.no/laravel/routing.html#anbefalt-struktur-for-routes';

    private const ROUTE_METHOD_NAMES = [
        'get',
        'post',
        'patch',
        'put',
        'delete',
    ];

    public function lint(Parser $parser)
    {
        $traverser = new NodeTraverser;

        $visitor = new FindingVisitor(function (Node $node) {
            return $node instanceof Node\Expr\StaticCall
                && ($node->class instanceof Node\Name && $node->class->toString() === 'Route')
                && in_array($node->name->name, self::ROUTE_METHOD_NAMES, true)
                && isset($node->args[1])
                && $node->args[1]->value instanceof Node\Expr\Array_
                && count($node->args[1]->value->items) > 1
                && $node->args[1]->value->items[0]->key !== null
                && $node->args[1]->value->items[1]->key !== null;
        });

        $traverser->addVisitor($visitor);

        $traverser->traverse($parser->parse($this->code));

        return $visitor->getFoundNodes();
    }
}
