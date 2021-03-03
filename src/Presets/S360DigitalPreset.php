<?php

namespace S360Digital\LaravelLinter\Presets;

use Tighten\Presets\PresetInterface;
use Tighten\Linters;

class S360DigitalPreset implements PresetInterface
{
    public function getLinters(): array
    {
        return [
            Linters\AlphabeticalImports::class,
            Linters\ApplyMiddlewareInRoutes::class,
            Linters\ArrayParametersOverViewWith::class,
            Linters\ConcatenationSpacing::class,
            Linters\ImportFacades::class,
            Linters\NoDatesPropertyOnModels::class,
            Linters\NoDump::class,
            Linters\NoJsonDirective::class,
            Linters\NoLeadingSlashesOnRoutePaths::class,
            Linters\NoParensEmptyInstantiations::class,
            Linters\NoSpaceAfterBladeDirectives::class,
            // Test this one:
            Linters\NoStringInterpolationWithoutBraces::class,
            Linters\NoUnusedImports::class,
            Linters\OneLineBetweenClassVisibilityChanges::class,
            // Test this one:
            Linters\QualifiedNamesOnlyForClassName::class,
            Linters\RemoveLeadingSlashNamespaces::class,
            // Test this one:
            Linters\RequestHelperFunctionWherePossible::class,
            // Test this one (Verify that it works when controllers are not pure rest):
            Linters\RestControllersMethodOrder::class,
            Linters\SpaceAfterBladeDirectives::class,
            Linters\SpacesAroundBladeRenderContent::class,
            Linters\TrailingCommasOnArrays::class,
            Linters\UseAuthHelperOverFacade::class,
            Linters\UseConfigOverEnv::class,
        ];
    }

    public function getFormatters(): array
    {
        return [];
    }
}
