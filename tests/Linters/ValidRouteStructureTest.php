<?php

namespace Tests\Linters;

use PHPUnit\Framework\TestCase;
use Indent\LaravelLinter\Linters\ValidRouteStructure;
use Tighten\TLint\TLint;

class ValidRouteStructureTest extends TestCase
{
    public function testCatchesInvalidRouteStructure()
    {
        $file = file_get_contents(__DIR__ . '/../fixtures/invalid/routes/web.php');

        $lints = (new TLint)->lint(new ValidRouteStructure($file));

        $this->assertSame(2, count($lints));
        $this->assertEquals(3, $lints[0]->getNode()->getLine());
        $this->assertEquals(12, $lints[1]->getNode()->getLine());
    }

    public function testValidRoutesFileIsNotReported()
    {
        $file = file_get_contents(__DIR__ . '/../fixtures/valid/routes/web.php');

        $lints = (new TLint)->lint(new ValidRouteStructure($file));

        $this->assertEmpty($lints);
    }
}
