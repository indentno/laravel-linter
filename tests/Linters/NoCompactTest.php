<?php

namespace Tests\Linters;

use PHPUnit\Framework\TestCase;
use S360Digital\LaravelLinter\Linters\NoCompact;
use Tighten\TLint\TLint;

class NoCompactTest extends TestCase
{
    public function testCatchesCompactCallInController()
    {
        $file = file_get_contents(__DIR__ . '/../fixtures/invalid/UserController.php');

        $lints = (new TLint)->lint(new NoCompact($file));

        $this->assertEquals(11, $lints[0]->getNode()->getLine());
    }

    public function testIgnoresControllersWithNoCompact()
    {
        $file = file_get_contents(__DIR__ . '/../fixtures/valid/UserController.php');

        $lints = (new TLint)->lint(new NoCompact($file));

        $this->assertEmpty($lints);
    }
}
