<?php

namespace LaravelFrontendPresets\TtallPreset;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Ui\UiCommand;

class TtallPresetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        UiCommand::macro('ttall', function ($command) {
            TtallPreset::install();

            $asciiLogo = <<<'EOT'
'########:'########::::'###::::'##:::::::'##:::::::
... ##..::... ##..::::'## ##::: ##::::::: ##:::::::
::: ##::::::: ##:::::'##:. ##:: ##::::::: ##:::::::
::: ##::::::: ##::::'##:::. ##: ##::::::: ##:::::::
::: ##::::::: ##:::: #########: ##::::::: ##:::::::
::: ##::::::: ##:::: ##.... ##: ##::::::: ##:::::::
::: ##::::::: ##:::: ##:::: ##: ########: ########:
:::..::::::::..:::::..:::::..::........::........::
EOT;
            $command->line("\n".$asciiLogo."\n");
            $command->info('Ttall scaffolding installed successfully.');

            if ($command->option('auth')) {
                TtallPreset::installAuth();

                $command->info('Ttall auth scaffolding installed successfully.');
            }

            $command->line('Please run "composer update && npm install && npm run dev" to install the new composer\'s packages and compile your fresh scaffolding.');

            if ($command->confirm('Would you like to show some love by starring the repo? 🥺')) {
                if (PHP_OS_FAMILY == 'Darwin') {
                    exec('open https://github.com/laravel-frontend-presets/ttall');
                }
                if (PHP_OS_FAMILY == 'Windows') {
                    exec('start https://github.com/laravel-frontend-presets/ttall');
                }
                if (PHP_OS_FAMILY == 'Linux') {
                    exec('xdg-open https://github.com/laravel-frontend-presets/ttall');
                }

                $command->line('Thanks! Means the world to me! 🥰');
            } else {
                $command->line('I understand, but am not going to pretend I\'m not sad about it...');
            }
        });

        Paginator::defaultView('pagination::default');

        Paginator::defaultSimpleView('pagination::simple-default');
    }
}
