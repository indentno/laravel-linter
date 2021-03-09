<?php

namespace Tests\Linters;

use PHPUnit\Framework\TestCase;
use S360Digital\LaravelLinter\Linters\PreventUseOfPhpDirectiveInBladeViews;
use Tighten\TLint;

class PreventUseOfPhpDirectiveInBladeViewsTest extends TestCase
{
    public function testCatchesPhpDirectiveInBladeFile()
    {
        $file = file_get_contents(__DIR__ . '/../fixtures/invalid/views/index.blade.php');

        $lints = (new TLint)->lint(new PreventUseOfPhpDirectiveInBladeViews($file));

        $this->assertEquals(4, $lints[0]->getNode()->getLine());
    }
}
