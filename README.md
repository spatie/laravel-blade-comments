#  Show Blade paths in your rendered output 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-blade-comments.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-blade-comments)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/spatie/laravel-blade-comments/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/spatie/laravel-blade-comments/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/spatie/laravel-blade-comments/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/spatie/laravel-blade-comments/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-blade-comments.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-blade-comments)

This package aims to help find your way in Laravel applications by injecting HTML comments in your rendered output. These comments allow you to discover which blade files, controllers or Livewire components are used by using your browsers developer tools (inspect element).

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-blade-comments.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-blade-comments)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require-dev spatie/laravel-blade-comments
```

You can optionally publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-blade-comments-config"
```

This is the content of the published config file:

```php
return [
    'enable' => env('APP_ENV') !== 'production',

    'precompilers' => [
        Spatie\BladeComments\Precompilers\BladeCommentsPrecompiler::class,
    ],

    'middleware' => [
        Spatie\BladeComments\Middleware\AddDebugInfoToResponse::class,
    ]
];
```

## Extending
The packages uses precompilers to add HTML comments to your HTML output by using Regex to find any Blade directives.
If you want to add support for custom Blade directives, you can create your own precompiler class and add it to the `precompilers` array in the config file. Take a look at the package's `BladeCommentsPrecompiler` class to see how it works.

```php

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tim Van Dijck](https://github.com/spatie)
- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
