<?php

namespace S360Digital\LaravelLinter\Presets;

use S360Digital\LaravelLinter\Linters\ControllerHasCorrectOrderForRestMethods;
use S360Digital\LaravelLinter\Linters\FormRequestForControllerValidation;
use S360Digital\LaravelLinter\Linters\ImportFacades;
use S360Digital\LaravelLinter\Linters\NoCompact;
use S360Digital\LaravelLinter\Linters\NoDump;
use S360Digital\LaravelLinter\Linters\NoStringInterpolationWithoutBraces;
use S360Digital\LaravelLinter\Linters\UseConfigOverEnv;
use S360Digital\LaravelLinter\Linters\ValidRouteStructure;
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

class S360DigitalPreset implements PresetInterface
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
