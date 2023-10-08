<?php

namespace Indent\LaravelLinter\Presets;

use Indent\LaravelLinter\Linters\ControllerHasCorrectOrderForRestMethods;
use Indent\LaravelLinter\Linters\FormRequestForControllerValidation;
use Indent\LaravelLinter\Linters\ImportFacades;
use Indent\LaravelLinter\Linters\NoCompact;
use Indent\LaravelLinter\Linters\NoDump;
use Indent\LaravelLinter\Linters\NoStringInterpolationWithoutBraces;
use Indent\LaravelLinter\Linters\RouteUrlsUsesKebabCasing;
use Indent\LaravelLinter\Linters\UseConfigOverEnv;
use Indent\LaravelLinter\Linters\ValidRouteStructure;
use Tighten\TLint\Linters\ApplyMiddlewareInRoutes;
use Tighten\TLint\Linters\ArrayParametersOverViewWith;
use Tighten\TLint\Linters\NoDatesPropertyOnModels;
use Tighten\TLint\Linters\NoJsonDirective;
use Tighten\TLint\Linters\NoLeadingSlashesOnRoutePaths;
use Tighten\TLint\Linters\NoSpaceAfterBladeDirectives;
use Tighten\TLint\Linters\QualifiedNamesOnlyForClassName;
use Tighten\TLint\Linters\RemoveLeadingSlashNamespaces;
use Tighten\TLint\Linters\SpaceAfterBladeDirectives;
use Tighten\TLint\Linters\SpacesAroundBladeRenderContent;
use Tighten\TLint\Linters\UseAnonymousMigrations;
use Tighten\TLint\Linters\UseAuthHelperOverFacade;
use Tighten\TLint\Presets\PresetInterface;

class IndentPreset implements PresetInterface
{
    public function getLinters(): array
    {
        return [
            ApplyMiddlewareInRoutes::class,
            ArrayParametersOverViewWith::class,
            FormRequestForControllerValidation::class,
            ImportFacades::class,
            NoCompact::class,
            NoDatesPropertyOnModels::class,
            NoDump::class,
            NoJsonDirective::class,
            NoLeadingSlashesOnRoutePaths::class,
            NoSpaceAfterBladeDirectives::class,
            NoStringInterpolationWithoutBraces::class,
            QualifiedNamesOnlyForClassName::class,
            RemoveLeadingSlashNamespaces::class,
            RouteUrlsUsesKebabCasing::class,
            ControllerHasCorrectOrderForRestMethods::class,
            SpaceAfterBladeDirectives::class,
            SpacesAroundBladeRenderContent::class,
            UseAuthHelperOverFacade::class,
            UseConfigOverEnv::class,
            ValidRouteStructure::class,
            UseAnonymousMigrations::class,
        ];
    }

    public function getFormatters(): array
    {
        return [];
    }
}
