# Very short description of the package

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require code16/jigsaw
```

## Usage

Add following to the env
```dotenv
JOCKO_API_URL=https://cms.code16.fr
JOCKO_API_TOKEN=...
```

Add following to your `config.php`
```php
[
    'jocko_api' => [
        'url' => env('JOCKO_API_URL'),
        'token' => env('JOCKO_API_TOKEN'),
    ],
]
```

### Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
