# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/code16/novak.svg?style=flat-square)](https://packagist.org/packages/code16/novak)
[![Total Downloads](https://img.shields.io/packagist/dt/code16/novak.svg?style=flat-square)](https://packagist.org/packages/code16/novak)
![GitHub Actions](https://github.com/code16/novak/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require code16/novak
```

## Usage

Add following to the env
```
NOVAK_API_URL=https://cms.code16.fr
NOVAK_API_KEY=...
```

Add following to your `config.php`
```
[
    'novak' => [
        'url' => env('NOVAK_API_URI'),
        'key' => env('NOVAK_API_KEY'),
    ],
]
```

```php
// Usage description here
```

### Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
