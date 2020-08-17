<?php

namespace Pktharindu\TtallPreset;

trait HandlesCodeHelperScaffolding
{
    protected static function updateCodeHelperComposerPackages(bool $dev = true): void
    {
        if (! file_exists(base_path('composer.json'))) {
            return;
        }

        $configurationKey = $dev ? 'require-dev' : 'require';

        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        $composer[$configurationKey] = static::updateCodeHelperComposerPackageArray(
            array_key_exists($configurationKey, $composer) ? $composer[$configurationKey] : [],
            $configurationKey
        );

        ksort($composer[$configurationKey]);

        file_put_contents(
            base_path('composer.json'),
            json_encode($composer, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    protected static function updateCodeHelperComposerPackageArray(array $composer, string $dev): array
    {
        if ($dev == 'require-dev') {
            return array_merge([
                'barryvdh/laravel-debugbar' => '^3.4',
                'barryvdh/laravel-ide-helper' => '^2.8',
                'brainmaestro/composer-git-hooks' => '^2.8',
                'friendsofphp/php-cs-fixer' => '^2.16',
                'nunomaduro/larastan' => '^0.6.2',
            ], $composer);
        } else {
            return array_merge([], $composer);
        }
    }

    protected static function updateCodeHelperPackagesScripts(): void
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages['scripts'] = static::updateCodeHelperPackagesScriptsArray(
            array_key_exists('scripts', $packages) ? $packages['scripts'] : []
        );

        ksort($packages['scripts']);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    protected static function updateCodeHelperPackagesScriptsArray(array $packages): array
    {
        return array_merge([
            'format' => "prettier --write 'resources/js/*.{js,jsx}'",
            'lint' => "eslint '**/*.{js,jsx}' --quiet --fix",
        ], $packages);
    }

    protected static function updateCodeHelperComposerScripts(): void
    {
        if (! file_exists(base_path('composer.json'))) {
            return;
        }

        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        $composer['scripts'] = static::updateCodeHelperComposerScriptsArray(
            array_key_exists('scripts', $composer) ? $composer['scripts'] : []
        );

        ksort($composer['scripts']);

        file_put_contents(
            base_path('composer.json'),
            json_encode($composer, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    protected static function updateCodeHelperComposerScriptsArray(array $composer): array
    {
        return array_merge([
            'post-update-cmd' => [
                'Illuminate\\Foundation\\ComposerScripts::postUpdate',
                '@php artisan ide-helper:generate',
                'cghooks update',
            ],
            'format' => 'php-cs-fixer fix --path-mode=intersection --config=.php_cs ./',
            'test' => '@php artisan test',
            'analyse' => 'phpstan analyse',
        ], $composer);
    }

    protected static function updateCodeHelperComposerExtra(): void
    {
        if (! file_exists(base_path('composer.json'))) {
            return;
        }

        $composer = json_decode(file_get_contents(base_path('composer.json')), true);

        $composer['extra']['hooks'] = static::updateCodeHelperComposerExtraHooksArray(
            array_key_exists('hooks', $composer['extra']) ? $composer['extra']['hooks'] : []
        );

        ksort($composer['extra']);

        file_put_contents(
            base_path('composer.json'),
            json_encode($composer, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }

    protected static function updateCodeHelperComposerExtraHooksArray(array $composer): array
    {
        return array_merge([
            'pre-commit' => [
                "STAGED_FILES=$(git diff --cached --name-only --diff-filter=ACM -- '*.php')",
                'php-cs-fixer fix',
                'git add $STAGED_FILES',
            ],
        ], $composer);
    }
}
