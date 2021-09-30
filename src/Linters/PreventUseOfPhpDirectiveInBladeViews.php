<?php

namespace S360Digital\LaravelLinter\Linters;

use PhpParser\Parser;
use Tighten\TLint\BaseLinter;
use Tighten\TLint\CustomNode;
use Tighten\TLint\Linters\Concerns\LintsBladeTemplates;

class PreventUseOfPhpDirectiveInBladeViews extends BaseLinter
{
    use LintsBladeTemplates;

    public const description = '@php blade directive is not allowed in blade views.';

    public function lint(Parser $parser)
    {
        $nodes = [];

        foreach ($this->getCodeLines() as $line => $codeLine) {
            $matches = [];

            // https://github.com/illuminate/view/blob/master/Compilers/BladeCompiler.php#L415
            preg_match(
                '/\B@(@?\w+(?:::\w+)?)([ \t]*)(\( ( (?>[^()]+) | (?3) )* \))?/x',
                $codeLine,
                $matches
            );

            $match = $matches[1] ?? null;

            if ($match === 'php') {
                $nodes[] = new CustomNode(['startLine' => $line + 1]);
            }
        }

        return $nodes;
    }
}
