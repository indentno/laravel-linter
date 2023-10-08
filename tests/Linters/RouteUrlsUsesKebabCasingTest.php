<?php

namespace Tests\Linters;

use Indent\LaravelLinter\Linters\RouteUrlsUsesKebabCasing;
use PHPUnit\Framework\TestCase;
use Tighten\TLint\TLint;

class RouteUrlsUsesKebabCasingTest extends TestCase
{
    public function testCatchesInvalidRouteUrls()
    {
        $file = <<<TEST
<?php

Route::get('newPassword', [NewPasswordController::class, 'create'])->name('newPassword.create');

Route::post('new-password', [NewPasswordController::class, 'store'])->name('newPassword.store');

Route::get('articleCategory', [ArticleCategoryController::class, 'index'])->name('articleCategory.index');
TEST;

        $lints = (new TLint)->lint(new RouteUrlsUsesKebabCasing($file));

        $this->assertSame(2, count($lints));
        $this->assertEquals(3, $lints[0]->getNode()->getLine());
        $this->assertEquals(7, $lints[1]->getNode()->getLine());
    }

    public function testCatchesInvalidRoutesEvenIfMethodWithIllegalValueIsNotFirst()
    {
        $file = <<<TEST
<?php

Route::name('newPassword.create')->get('newPassword', [NewPasswordController::class, 'create']);
Route::name('newPassword.create')->get('new-password', [NewPasswordController::class, 'create']);
Route::name('newPassword.store')
    ->middleware('web')
    ->post('newPassword', [NewPasswordController::class, 'store']);
Route::name('newPassword.store')
    ->middleware('web')
    ->post('new-password', [NewPasswordController::class, 'store']);
TEST;

        $lints = (new TLint)->lint(new RouteUrlsUsesKebabCasing($file));

        $this->assertSame(2, count($lints));
        $this->assertEquals(3, $lints[0]->getNode()->getLine());
        $this->assertEquals(5, $lints[1]->getNode()->getLine());
    }

    public function testRouteGroupWithValidPrefixPasses()
    {
        $file = <<<TEST
<?php

Route::group(['prefix' => 'new-password'], function () {
    Route::get('/', [NewPasswordController::class, 'create'])->name('newPassword.create');
    Route::post('/', [NewPasswordController::class, 'store'])->name('newPassword.store');
});
TEST;

        $lints = (new TLint)->lint(new RouteUrlsUsesKebabCasing($file));

        $this->assertSame(0, count($lints));
    }

    public function testRouteGroupWithInvalidPrefixInArrayIsFlagged()
    {
        $file = <<<TEST
<?php

Route::group(['prefix' => 'newPassword'], function () {
    Route::get('/', [NewPasswordController::class, 'create'])->name('newPassword.create');
    Route::post('/', [NewPasswordController::class, 'store'])->name('newPassword.store');
})->middleware('testing');

Route::group(['prefix' => 'new-password'], function () {
    Route::get('/', [NewPasswordController::class, 'create'])->name('newPassword.create');
    Route::post('/', [NewPasswordController::class, 'store'])->name('newPassword.store');
})->middleware('testing');
TEST;

        $lints = (new TLint)->lint(new RouteUrlsUsesKebabCasing($file));

        $this->assertSame(1, count($lints));
        $this->assertEquals(3, $lints[0]->getNode()->getLine());
    }

    public function testRouteGroupWithInvalidPrefixInArrayAndMultipleKeysIsFlagged()
    {
        $file = <<<TEST
<?php

Route::group(['middleware' => 'web', 'prefix' => 'newPassword'], function () {
    Route::get('/', [NewPasswordController::class, 'create'])->name('newPassword.create');
    Route::post('/', [NewPasswordController::class, 'store'])->name('newPassword.store');
})->middleware('testing');

Route::group(['middleware' => 'web', 'prefix' => 'new-password'], function () {
    Route::get('/', [NewPasswordController::class, 'create'])->name('newPassword.create');
    Route::post('/', [NewPasswordController::class, 'store'])->name('newPassword.store');
})->middleware('testing');
TEST;

        $lints = (new TLint)->lint(new RouteUrlsUsesKebabCasing($file));

        $this->assertSame(1, count($lints));
        $this->assertEquals(3, $lints[0]->getNode()->getLine());
    }

    public function testRouteGroupWithInvalidPrefixAsMethodIsFlagged()
    {
        $file = <<<TEST
<?php

Route::prefix('newPassword')->group(function () {
    Route::get('/', [NewPasswordController::class, 'create'])->name('newPassword.create');
    Route::post('/', [NewPasswordController::class, 'store'])->name('newPassword.store');
});

Route::prefix('new-password')->group(function () {
    Route::get('/', [NewPasswordController::class, 'create'])->name('newPassword.create');
    Route::post('/', [NewPasswordController::class, 'store'])->name('newPassword.store');
});

Route::group(function () {
    Route::get('/', [NewPasswordController::class, 'create'])->name('newPassword.create');
    Route::post('/', [NewPasswordController::class, 'store'])->name('newPassword.store');
})->prefix('newPassword');

Route::group(function () {
    Route::get('/', [NewPasswordController::class, 'create'])->name('newPassword.create');
    Route::post('/', [NewPasswordController::class, 'store'])->name('newPassword.store');
})->prefix('new-password');

Route::group(function () {
    Route::get('/', [NewPasswordController::class, 'create'])->name('newPassword.create');
    Route::post('/', [NewPasswordController::class, 'store'])->name('newPassword.store');
})->middleware('web')->prefix('newPassword');

Route::group(function () {
    Route::get('/', [NewPasswordController::class, 'create'])->name('newPassword.create');
    Route::post('/', [NewPasswordController::class, 'store'])->name('newPassword.store');
})->middleware('web')->prefix('new-password');
TEST;

        $lints = (new TLint)->lint(new RouteUrlsUsesKebabCasing($file));

        $this->assertSame(3, count($lints));
        $this->assertEquals(3, $lints[0]->getNode()->getLine());
        $this->assertEquals(13, $lints[1]->getNode()->getLine());
        $this->assertEquals(23, $lints[2]->getNode()->getLine());
    }

    public function testValidRoutesPassesTheTest()
    {
        $file = <<<TEST
<?php

Route::get('new-password', [NewPasswordController::class, 'create'])->name('newPassword.create');

Route::get('article-category', [ArticleCategoryController::class, 'index'])->name('articleCategory.index');
TEST;

        $lints = (new TLint)->lint(new RouteUrlsUsesKebabCasing($file));

        $this->assertEmpty($lints);
    }
}
