<?php

namespace S360Digital\LaravelLinter\Presets;

use S360Digital\LaravelLinter\Linters\AnonymousMigrations;
use S360Digital\LaravelLinter\Linters\ApplyMiddlewareInRoutes;
use S360Digital\LaravelLinter\Linters\ArrayParametersOverViewWith;
use S360Digital\LaravelLinter\Linters\ControllerHasCorrectOrderForRestMethods;
use S360Digital\LaravelLinter\Linters\FormRequestForControllerValidation;
use S360Digital\LaravelLinter\Linters\NoCompact;
use S360Digital\LaravelLinter\Linters\PreventUseOfPhpDirectiveInBladeViews;
use S360Digital\LaravelLinter\Linters\ValidRouteStructure;
use Tighten\TLint\Linters\AlphabeticalImports;
use Tighten\TLint\Linters\ConcatenationSpacing;
use Tighten\TLint\Linters\ImportFacades;
use Tighten\TLint\Linters\NoDatesPropertyOnModels;
use Tighten\TLint\Linters\NoDump;
use Tighten\TLint\Linters\NoJsonDirective;
use Tighten\TLint\Linters\NoLeadingSlashesOnRoutePaths;
use Tighten\TLint\Linters\NoParensEmptyInstantiations;
use Tighten\TLint\Linters\NoSpaceAfterBladeDirectives;
use Tighten\TLint\Linters\NoStringInterpolationWithoutBraces;
use Tighten\TLint\Linters\NoUnusedImports;
use Tighten\TLint\Linters\QualifiedNamesOnlyForClassName;
use Tighten\TLint\Linters\RemoveLeadingSlashNamespaces;
use Tighten\TLint\Linters\SpaceAfterBladeDirectives;
use Tighten\TLint\Linters\SpacesAroundBladeRenderContent;
use Tighten\TLint\Linters\TrailingCommasOnArrays;
use Tighten\TLint\Linters\UseAuthHelperOverFacade;
use Tighten\TLint\Linters\UseConfigOverEnv;
use Tighten\TLint\Presets\PresetInterface;

class S360DigitalPreset implements PresetInterface
{
    public function getLinters(): array
    {
        return [
            AlphabeticalImports::class,
            ApplyMiddlewareInRoutes::class,
            ArrayParametersOverViewWith::class,
            ConcatenationSpacing::class,
            FormRequestForControllerValidation::class,
            ImportFacades::class,
            NoCompact::class,
            NoDatesPropertyOnModels::class,
            NoDump::class,
            NoJsonDirective::class,
            NoLeadingSlashesOnRoutePaths::class,
            NoParensEmptyInstantiations::class,
            NoSpaceAfterBladeDirectives::class,
            NoStringInterpolationWithoutBraces::class,
            NoUnusedImports::class,
            PreventUseOfPhpDirectiveInBladeViews::class,
            QualifiedNamesOnlyForClassName::class,
            RemoveLeadingSlashNamespaces::class,
            ControllerHasCorrectOrderForRestMethods::class,
            SpaceAfterBladeDirectives::class,
            SpacesAroundBladeRenderContent::class,
            TrailingCommasOnArrays::class,
            UseAuthHelperOverFacade::class,
            UseConfigOverEnv::class,
            ValidRouteStructure::class,
            AnonymousMigrations::class,
        ];
    }

    public function getFormatters(): array
    {
        return [];
    }
}
