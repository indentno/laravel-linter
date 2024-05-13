<?php

namespace Indent\LaravelLinter\Linters;

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\FindingVisitor;
use PhpParser\Parser;
use Tighten\TLint\BaseLinter;
use Tighten\TLint\Linters\Concerns\LintsRoutesFiles;

class RouteUrlsUsesKebabCasing extends BaseLinter
{
    use LintsRoutesFiles;

    public const DESCRIPTION = 'Route urls must use kebab casing.';

    private const ROUTE_METHOD_NAMES = [
        'get',
        'post',
        'patch',
        'put',
        'delete',
        'options',
    ];

    public function lint(Parser $parser)
    {
        $traverser = new NodeTraverser;

        $visitor = new FindingVisitor(function (Node $node) {
            if ($this->hasMatchForRegularRouteEntry($node)) {
                return true;
            }

            if ($this->hasMatchForRouteGroup($node)) {
                return true;
            }

            return false;
        });

        $traverser->addVisitor($visitor);
        $traverser->traverse($parser->parse($this->code));

        return $visitor->getFoundNodes();
    }

    private function hasMatchForRegularRouteEntry(mixed $node): bool
    {
        if ($node instanceof Node\Expr\MethodCall
            && in_array($node->name->name, self::ROUTE_METHOD_NAMES, true)
            && $this->routeClassIsTheStaticRootNode($node)
            && isset($node->args[0]->value->value)
            && $this->stringIsNotKebabCased($node->args[0]->value->value)
        ) {
            return true;
        }

        return $node instanceof Node\Expr\StaticCall
            && ($node->class instanceof Node\Name && $node->class->toString() === 'Route')
            && in_array($node->name->name, self::ROUTE_METHOD_NAMES, true)
            && isset($node->args[0]->value->value)
            && $this->stringIsNotKebabCased($node->args[0]->value->value);
    }

    private function hasMatchForRouteGroup(mixed $node): bool
    {
        // Handles Route::prefix case
        if ($node instanceof Node\Expr\StaticCall
            && ($node->class instanceof Node\Name && $node->class->toString() === 'Route')
            && $node->name->name === 'prefix'
            && count($node->args) > 0
            && $node->args[0]->value instanceof Node\Scalar\String_
            && $this->stringIsNotKebabCased($node->args[0]->value->value)) {
            return true;
        }

        // Handles case where "prefix" is a chained method call of Route::
        if ($node instanceof Node\Expr\MethodCall
            && $node->name->name === 'prefix'
            && $this->routeClassIsTheStaticRootNode($node)
            && count($node->args) === 1
            && $node->args[0]->value instanceof Node\Scalar\String_
            && $this->stringIsNotKebabCased($node->args[0]->value->value)
        ) {
            return true;
        }

        // Handles case where prefix is defined in the group array (Route::group(['prefix' => ...], ...)
        if ($node instanceof Node\Expr\StaticCall
            && ($node->class instanceof Node\Name && $node->class->toString() === 'Route')
            && $node->name->name === 'group') {
            if ($node->args[0]->value instanceof Node\Expr\Array_) {
                $items = array_values(array_filter($node->args[0]->value->items, function (Node\Expr\ArrayItem $item) {
                    return $item->key->value === 'prefix';
                }));

                if (count($items) > 0 and $this->stringIsNotKebabCased($items[0]->value->value)) {
                    return true;
                }
            }
        }

        return false;
    }

    private function routeClassIsTheStaticRootNode(Node\Expr\MethodCall $node): bool
    {
        $rootNode = $this->recursivelyGetRootStaticNode($node);
        $rootName = $rootNode->class->getParts()[0] ?? '';

        return $rootName === 'Route';
    }

    private function recursivelyGetRootStaticNode(Node\Expr\MethodCall|Node\Expr\StaticCall $node): Node\Expr\StaticCall
    {
        if ($node instanceof Node\Expr\StaticCall) {
            return $node;
        }

        return $this->recursivelyGetRootStaticNode($node->var);
    }

    public function stringIsNotKebabCased(string $nodeValue): bool
    {
        $value = $nodeValue;

        if (!ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));
            $value = preg_replace('/(.)(?=[A-Z])/u', '$1-', $value);
            $value = mb_strtolower($value, 'UTF-8');
        }

        return $nodeValue !== $value;
    }
}
