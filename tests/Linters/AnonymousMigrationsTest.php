<?php

namespace Tests\Linters;

use PHPUnit\Framework\TestCase;
use S360Digital\LaravelLinter\Linters\AnonymousMigrations;
use Tighten\TLint;

class AnonymousMigrationsTest extends TestCase
{
    public function testFailsWhenMigrationHasClassName()
    {
        $file = file_get_contents(__DIR__ . '/../fixtures/invalid/database/migrations/migration_with_class_name.php');

        $lints = (new TLint)->lint(new AnonymousMigrations($file));

        $this->assertEquals(7, $lints[0]->getNode()->getLine());
    }

    public function testIgnoresCasesWhereMigrationIsAnonymous()
    {
        $file = file_get_contents(
            __DIR__ . '/../fixtures/valid/database/migrations/migration_with_anonymous_class.php'
        );

        $lints = (new TLint)->lint(new AnonymousMigrations($file));

        $this->assertEmpty($lints);
    }
}
