<?php

namespace S360Digital\LaravelLinter\Linters;

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\FindingVisitor;
use PhpParser\Parser;
use S360Digital\LaravelLinter\Linters\Concerns\LintsControllers;
use Tighten\BaseLinter;

class ControllerHasCorrectOrderForRestMethods extends BaseLinter
{
    use LintsControllers;

    public const description = 'REST methods in controllers should match the ordering here:'
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
                    return $stmt instanceof Node\Stmt\ClassMethod;
                }));

                $restfulMethods = array_intersect(self::RESTFUL_METHOD_NAMES, $methodNames);

                if (count($restfulMethods) > 0) {
                    $currentMethodOrder = array_intersect($methodNames, self::RESTFUL_METHOD_NAMES);

                    return array_values($restfulMethods) !== array_values($currentMethodOrder);
                }
            }

            return false;
        });

        $traverser->addVisitor($visitor);

        $traverser->traverse($parser->parse($this->code));

        return $visitor->getFoundNodes();
    }
}