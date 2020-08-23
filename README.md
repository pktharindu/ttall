# TTALL Preset For Laravel 7 and Up

[![License: MIT](https://img.shields.io/badge/license-MIT-green)](/LICENSE)
[![CI Status](https://github.com/pktharindu/ttall/workflows/tests/badge.svg)](https://github.com/pktharindu/ttall/actions)
[![Total Downloads](https://poser.pugx.org/pktharindu/ttall/d/total.svg)](https://packagist.org/packages/pktharindu/ttall)

An opinionated Laravel front-end scaffolding preset for TTALL stack - Tailwindcss | Turbolinks | Alpine.js | Laravel | Livewire 🚀

It comes bundled with some helpful packages and their configurations (optional):

- Laravel debugbar
- Laravel IDE Helper
- Php CS Fixer
- Larastan
- Eslint (Airbnb rules)
- Prettier
- Composer Git Hooks

![Screen Record](https://raw.githubusercontent.com/pktharindu/ttall/master/screenshots/screen-record.gif)

If you like this package, show some love by starring the repo. ⭐❤

## Contents

- [TTALL Preset For Laravel 7 and Up](#ttall-preset-for-laravel-7-and-up)
  - [Contents](#contents)
  - [Installation](#installation)
    - [For Basic Presets (without authentication)](#for-basic-presets-without-authentication)
    - [For Presets with Authentication](#for-presets-with-authentication)
  - [Configuration](#configuration)
  - [Options](#options)
    - [Code Helpers](#code-helpers)
      - [Scripts](#scripts)
  - [Support](#support)
  - [Credits](#credits)
  - [License](#license)


## Installation

To install this preset on your laravel application, run:

``` bash
composer require pktharindu/ttall --dev
```

### For Basic Presets (without authentication)

To scaffold the basic preset without authentication, run:
``` bash
php artisan ui ttall
```

### For Presets with Authentication

To scaffold the basic preset, auth route entry and auth views in one go, run:
``` bash
php artisan ui ttall --auth
```
Finally run `composer update && npm install && npm run dev` to install the new composer packages and compile your fresh scaffolding.

## Configuration

Add a new i18n string in the `resources/lang/XX/pagination.php` file for each language that your app uses:

```php
'previous' => '&laquo; Previous',
'next' => 'Next &raquo;',
'goto_page' => 'Goto page #:page', // Add this line
```

This will help with accessibility.

```html
<li>
  <a href="URL?page=2" class="..." aria-label="Goto page #2">
    2
  </a>
</li>
```

## Options

As this preset is designed to get you up-and-running quickly, it comes bundled with some extra options that will take you even further. To utilize these options, use the `--option` flag when installing the preset.

Usage Example:

```bash
php artisan ui ttall --option=code-helpers
```

### Code Helpers

`code-helpers` option will install and configure the below packages to help you with the development:

- Laravel debugbar
- Laravel IDE Helper
- Php CS Fixer
- Larastan
- Eslint (Airbnb rules)
- Prettier
- Composer Git Hooks

#### Scripts

A composer's script is added automatically to tell `Laravel IDE Helper` to rescan your `Facades` files and update git hooks after every `composer update` :

```json
"scripts": {
    "post-update-cmd": [
        "Illuminate\\Foundation\\ComposerScripts::postUpdate",
        "@php artisan ide-helper:generate",
        "cghooks update"
    ]
}
```

Also, Git Hooks are added to format your php files automatically before each commit.

```json
"extra": {
    "hooks": {
        "pre-commit": [
            "STAGED_FILES=$(git diff --cached --name-only --diff-filter=ACM -- '*.php')",
            "php-cs-fixer fix",
            "git add $STAGED_FILES"
        ]
    }
},
```

Scripts are also added to your `package.json` and `composer.json` to run specific actions :

- `composer format` : will use `php-cs-fixer` to format your php files
- `composer test` : will use the `php artisan test` command to run your phpunit tests
- `composer analyse` : will use `larastan` to analyse your code
- `npm run format` : will format your js files on `resources/js` folder
- `npm run lint` : will find issues in your js files based on Airbnb's rules and try to fix them

## Support

If you require any support please contact me on [Twitter](https://twitter.com/CallMeTharindu) or open an issue on this repository.

## Credits

- [P. K. Tharindu](https://github.com/pktharindu)
- [All Contributors](../../contributors)

This Package is inspired by [laravel-frontend-presets/tall](https://github.com/laravel-frontend-presets/tall) and [YannickYayo/laravel-preset-ttall](https://github.com/YannickYayo/laravel-preset-ttall). I wanted to have a combination of both. Thanks to all authors of these packages.

## License

Licensed under the MIT license, see [LICENSE](/LICENSE) for details.
