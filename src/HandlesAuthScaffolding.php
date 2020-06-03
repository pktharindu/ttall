<?php

namespace Pktharindu\TtallPreset;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

trait HandlesAuthScaffolding
{
    protected static function scaffoldAuth(): void
    {
        $filesystem = new Filesystem();

        $filesystem->copyDirectory(__DIR__.'/stubs/auth', base_path());

        collect($filesystem->allFiles(base_path('vendor/laravel/ui/stubs/migrations')))
            ->each(function (SplFileInfo $file) use ($filesystem) {
                $filesystem->copy(
                    $file->getPathname(),
                    database_path('migrations/'.$file->getFilename())
                );
            });
    }

    protected static function scaffoldAuthController(): void
    {
        if (! is_dir($directory = app_path('Http/Controllers/Auth'))) {
            mkdir($directory, 0755, true);
        }

        $filesystem = new Filesystem();

        collect($filesystem->allFiles(base_path('vendor/laravel/ui/stubs/Auth')))
            ->filter(function (SplFileInfo $file) {
                return in_array($file->getFilenameWithoutExtension(), [
                    'LoginController',
                    'VerificationController',
                ], true);
            })
            ->each(function (SplFileInfo $file) use ($filesystem) {
                $filesystem->copy(
                    $file->getPathname(),
                    app_path('Http/Controllers/Auth/'.Str::replaceLast('.stub', '.php', $file->getFilename()))
                );
            });
    }
}
