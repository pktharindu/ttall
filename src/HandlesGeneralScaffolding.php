<?php

namespace Pktharindu\TtallPreset;

use Illuminate\Filesystem\Filesystem;

trait HandlesGeneralScaffolding
{
    protected static function updateComposerPackages(bool $dev = true): void
    {
        if (! file_exists(base_path('composer.json'))) {
            return;
        }

        $configurationKey = $dev ? 'require-dev' : 'require';

        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        $composer[$configurationKey] = static::updateComposerPackageArray(
            array_key_exists($configurationKey, $composer) ? $composer[$configurationKey] : [],
            $configurationKey
        );

        ksort($composer[$configurationKey]);

        file_put_contents(
            base_path('composer.json'),
            json_encode($composer, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    protected static function updateComposerPackageArray(array $composer, string $dev): array
    {
        if ($dev == 'require-dev') {
            return array_merge([], $composer);
        } else {
            return array_merge([
                'laravel/ui' => '^2.0',
                'livewire/livewire' => '^1.0',
            ], $composer);
        }
    }

    protected static function updatePackagesScripts(): void
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        ksort($packages['scripts']);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    protected static function scaffoldDefaults(): void
    {
        $filesystem = new Filesystem();

        $filesystem->copyDirectory(__DIR__.'/stubs/default', base_path());
    }
}
