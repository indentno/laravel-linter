<?php

namespace S360Digital\LaravelLinter\Linters;

use Tighten\TLint\Linters\Concerns\LintsControllers;
use Tighten\TLint\BaseLinter;
use PhpParser\Parser;
use PhpParser\NodeVisitor\FindingVisitor;
use PhpParser\NodeTraverser;
use PhpParser\Node;

class ControllerHasCorrectOrderForRestMethods extends BaseLinter
{
    use LintsControllers;

    public const DESCRIPTION = 'REST methods in controllers should match the ordering here:'
        . ' https://laravel.com/docs/8.x/controllers#actions-handled-by-resource-controller';

    protected const RESTFUL_METHOD_NAMES = [
        'index',
        'create',
        'store',
        'show',
        'edit',
        'update',
        'destroy',
    ];

    public function lint(Parser $parser)
    {
        $traverser = new NodeTraverser;

        $visitor = new FindingVisitor(function (Node $node) {
            if ($node instanceof Node\Stmt\Class_) {
                $methodNames = array_map(function ($stmt) {
                    return $stmt->name->name;
                }, array_filter($node->stmts, function ($stmt) {
                    return $stmt instanceof Node\Stmt\ClassMethod && $stmt->name->name !== '__construct';
                }));
                $methodNames = array_values($methodNames);

                $restfulMethods = array_intersect(self::RESTFUL_METHOD_NAMES, $methodNames);

                if (count($restfulMethods) > 0) {
                    $currentMethodOrder = array_intersect($methodNames, self::RESTFUL_METHOD_NAMES);

                    return array_values($restfulMethods) !== $currentMethodOrder;
                }
            }

            return false;
        });

        $traverser->addVisitor($visitor);

        $traverser->traverse($parser->parse($this->code));

        return $visitor->getFoundNodes();
    }
}
