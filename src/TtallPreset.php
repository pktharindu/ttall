<?php

namespace LaravelFrontendPresets\TtallPreset;

use Illuminate\Support\Arr;
use Laravel\Ui\Presets\Preset;

class TtallPreset extends Preset
{
    use HandlesAuthScaffolding;
    use HandlesGeneralScaffolding;
    use HandlesCodeHelperScaffolding;

    const NPM_PACKAGES_TO_ADD = [
        '@tailwindcss/custom-forms' => '^0.2',
        '@tailwindcss/ui' => '^0.1',
        'alpinejs' => '^2.2',
        'laravel-mix' => '^5.0.1',
        'laravel-mix-tailwind' => '^0.1.0',
        'tailwindcss' => '^1.4',
        'turbolinks' => '^5.2.0',
    ];

    const DEV_NPM_PACKAGES_TO_ADD = [
        'eslint' => '^6.8.0',
        'eslint-config-airbnb' => '^18.0.1',
        'eslint-config-prettier' => '^6.10.0',
        'eslint-plugin-import' => '^2.20.1',
        'eslint-plugin-jsx-a11y' => '^6.2.3',
        'eslint-plugin-react' => '^7.18.3',
        'eslint-plugin-react-hooks' => '^1.7.0',
        'prettier' => '^1.19.1',
    ];

    const NPM_PACKAGES_TO_REMOVE = [
        'axios',
        'laravel-mix',
        'lodash',
    ];

    public static function install(): void
    {
        static::updatePackages();
        static::updatePackages(false);
        static::updateComposerPackages();
        static::updateComposerPackages(false);
        static::updatePackagesScripts();
        static::scaffoldDefaults();
        static::installCodeHelpers();
    }

    public static function installAuth(): void
    {
        static::scaffoldAuth();

        static::scaffoldAuthController();
    }

    public static function installCodeHelpers(): void
    {
        static::updateCodeHelperComposerPackages();
        static::updateCodeHelperComposerPackages(false);
        static::updateCodeHelperPackagesScripts();
        static::updateCodeHelperComposerScripts();
        static::updateCodeHelperComposerExtra();
    }

    protected static function updatePackageArray(array $packages, string $dev): array
    {
        if ($dev == 'devDependencies') {
            return array_merge(
                static::DEV_NPM_PACKAGES_TO_ADD,
                Arr::except($packages, static::NPM_PACKAGES_TO_REMOVE)
            );
        } else {
            return array_merge(
                static::NPM_PACKAGES_TO_ADD,
                Arr::except($packages, static::NPM_PACKAGES_TO_REMOVE)
            );
        }
    }
}
