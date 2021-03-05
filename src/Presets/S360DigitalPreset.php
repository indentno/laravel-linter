<?php

namespace S360Digital\LaravelLinter\Presets;

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
            // TODO: Needs to be remade with our own "LintsControllers" trait
//            ApplyMiddlewareInRoutes::class,
            // TODO: Needs to be remade with our own "LintsControllers" trait
//            ArrayParametersOverViewWith::class,
            ConcatenationSpacing::class,
            ImportFacades::class,
            NoDatesPropertyOnModels::class,
            NoDump::class,
            NoJsonDirective::class,
            NoLeadingSlashesOnRoutePaths::class,
            NoParensEmptyInstantiations::class,
            NoSpaceAfterBladeDirectives::class,
            NoStringInterpolationWithoutBraces::class,
            NoUnusedImports::class,
            QualifiedNamesOnlyForClassName::class,
            RemoveLeadingSlashNamespaces::class,
            // TODO: Needs to be remade with our own "LintsControllers" trait
//            RequestHelperFunctionWherePossible::class,
            // Test this one (Verify that it works when controllers are not pure rest):
            // TODO: Needs to be remade with our own "LintsControllers" trait
//            RestControllersMethodOrder::class,
            SpaceAfterBladeDirectives::class,
            SpacesAroundBladeRenderContent::class,
            TrailingCommasOnArrays::class,
            UseAuthHelperOverFacade::class,
            UseConfigOverEnv::class,
        ];
    }

    public function getFormatters(): array
    {
        return [];
    }
}
