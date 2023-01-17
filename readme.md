# laravel-linter

> Linting for your laravel project.

[![Build Status](https://travis-ci.com/indentno/laravel-linter.svg?branch=master)](https://travis-ci.com/indentno/laravel-linter)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)](http://makeapullrequest.com)
[![psr-2](https://img.shields.io/badge/code_style-PSR_2-blue.svg)](http://www.php-fig.org/psr/psr-2/)

A laravel linter based on the [tlint](https://github.com/tighten/tlint) package from the folks over at Tighten.


## Installation

Install the package as a dev dependency:

```bash
composer require indentno/laravel-linter --dev
```

Create a config (`tlint.json`), at the root of your repository, with the following contents:

```json
{
  "preset": "Indent\\LaravelLinter\\Presets\\IndentPreset",
  "excluded": [
    "tests/",
    "database/"
  ]
}
```

## Usage

Run the linter with all linters in the preset:

```bash
./vendor/bin/tlint
```

Run the linter against a single file or directory:

```bash
./vendor/bin/tlint lint app/Http/Controllers/PageController.php
./vendor/bin/tlint lint app
```

Lint the project with a single linter:

```bash
./vendor/bin/tlint --only="NoCompact"
```

## Configuration

The `tlint.json` config supports three different config keys.

### Preset

The "preset" defines which preset that should be used for linting the project. A preset is basicly just a set of linters, or rules, that the project should adhere to.

### Excluded

"excluded" is an array of paths that should be excluded from the linting process.

### Disabled

The "disabled" key can be used to disable a set of linters from being run in your project.

```json
{
  "preset": "Indent\\LaravelLinter\\Presets\\IndentPreset",
  "disabled": [
      "NoCompact",
      "UseConfigOverEnv"
  ],
  "excluded": [
    "tests/",
    "database/"
  ]
}
```

## Rules

An overview of rules that needs further explanation.

### ValidRouteStructure

Routes should be structured the way we prefer.

**Examples**
```php
Route::get('articles', [ArticleController::class, 'index'])->name('article.index');

Route::patch('page/{id}', [PageController::class, 'update'])
    ->name('admin.page.update')
    ->middleware(CanUpdatePage::class);
```

## License

MIT © [Indent](https://indent.no/)
