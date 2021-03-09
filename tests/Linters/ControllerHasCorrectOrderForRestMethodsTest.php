<?php

namespace Tests\Linters;

use PHPUnit\Framework\TestCase;
use S360Digital\LaravelLinter\Linters\ControllerHasCorrectOrderForRestMethods;
use Tighten\TLint;

class ControllerHasCorrectOrderForRestMethodsTest extends TestCase
{
    public function testCatchesControllerWhenRestMethodsAreOrderedIncorrectly()
    {
        $file = file_get_contents(__DIR__ . '/../fixtures/invalid/UserController.php');

        $lints = (new TLint)->lint(new ControllerHasCorrectOrderForRestMethods($file));

        $this->assertNotEmpty($lints);
    }

    public function testCatchesControllerWhenRestMethodsAreOrderedCorrectlyButOtherMethodSneaksInBetween()
    {
        $file = file_get_contents(__DIR__ . '/../fixtures/invalid/PageController.php');

        $lints = (new TLint)->lint(new ControllerHasCorrectOrderForRestMethods($file));

        $this->assertNotEmpty($lints);
    }

    public function testControllerPassesWhenRestMethodsAreOrderedCorrectlyAndNoOtherMethodsAreInBetween()
    {
        $file = file_get_contents(__DIR__ . '/../fixtures/valid/UserController.php');

        $lints = (new TLint)->lint(new ControllerHasCorrectOrderForRestMethods($file));

        $this->assertEmpty($lints);
    }
}
