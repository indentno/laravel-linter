<?php

namespace Tests\Linters;

use PHPUnit\Framework\TestCase;
use S360Digital\LaravelLinter\Linters\FormRequestForControllerValidation;
use Tighten\TLint\TLint;

class FormRequestForControllerValidationTest extends TestCase
{
    public function testCatchesThisValidateCallInController()
    {
        $file = file_get_contents(__DIR__ . '/../fixtures/invalid/UserController.php');

        $lints = (new TLint)->lint(new FormRequestForControllerValidation($file));

        $this->assertEquals(28, $lints[0]->getNode()->getLine());
    }

    public function testControllerPassesWhenValidationIsDoneCorrectly()
    {
        $file = file_get_contents(__DIR__ . '/../fixtures/valid/UserController.php');

        $lints = (new TLint)->lint(new FormRequestForControllerValidation($file));

        $this->assertEmpty($lints);
    }
}
