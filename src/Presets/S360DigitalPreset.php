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
use Tighten\Linters\AlphabeticalImports;
use Tighten\Linters\ConcatenationSpacing;
use Tighten\Linters\ImportFacades;
use Tighten\Linters\NoDatesPropertyOnModels;
use Tighten\Linters\NoDump;
use Tighten\Linters\NoJsonDirective;
use Tighten\Linters\NoLeadingSlashesOnRoutePaths;
use Tighten\Linters\NoParensEmptyInstantiations;
use Tighten\Linters\NoSpaceAfterBladeDirectives;
use Tighten\Linters\NoStringInterpolationWithoutBraces;
use Tighten\Linters\NoUnusedImports;
use Tighten\Linters\QualifiedNamesOnlyForClassName;
use Tighten\Linters\RemoveLeadingSlashNamespaces;
use Tighten\Linters\SpaceAfterBladeDirectives;
use Tighten\Linters\SpacesAroundBladeRenderContent;
use Tighten\Linters\TrailingCommasOnArrays;
use Tighten\Linters\UseAuthHelperOverFacade;
use Tighten\Linters\UseConfigOverEnv;
use Tighten\Presets\PresetInterface;

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
