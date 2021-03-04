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
            // TODO: Needs to be remade with our own "LintsControllers" trait
//            Linters\ApplyMiddlewareInRoutes::class,
            // TODO: Needs to be remade with our own "LintsControllers" trait
//            Linters\ArrayParametersOverViewWith::class,
            Linters\ConcatenationSpacing::class,
            Linters\ImportFacades::class,
            Linters\NoDatesPropertyOnModels::class,
            Linters\NoDump::class,
            Linters\NoJsonDirective::class,
            Linters\NoLeadingSlashesOnRoutePaths::class,
            Linters\NoParensEmptyInstantiations::class,
            Linters\NoSpaceAfterBladeDirectives::class,
            Linters\NoStringInterpolationWithoutBraces::class,
            Linters\NoUnusedImports::class,
            Linters\QualifiedNamesOnlyForClassName::class,
            Linters\RemoveLeadingSlashNamespaces::class,
            // TODO: Needs to be remade with our own "LintsControllers" trait
//            Linters\RequestHelperFunctionWherePossible::class,
            // Test this one (Verify that it works when controllers are not pure rest):
            // TODO: Needs to be remade with our own "LintsControllers" trait
//            Linters\RestControllersMethodOrder::class,
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
