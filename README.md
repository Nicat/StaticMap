# Laravel Static Map Generator

## Installation

First, pull in the package through Composer.

Run `composer require nicat/static-map`

And then, if using Laravel 5, include the service provider within `config/app.php`.

```php
'providers' => [
    Nicat\StaticMap\StaticMapServiceProvider::class,
];
```

And, for convenience, add a facade alias to this same file at the bottom:

```php
'aliases' => [
    'StaticMap' => Nicat\StaticMap\Facade\StaticMap::class,
];
```

## Usage

Within your controllers, before you perform a redirect...

```php
StaticMap::Google('London')
```

You may also do:

- `StaticMap::Google('London')`
- `StaticMap::Google('37.6213129,-122.3811441')`
- `StaticMap::GoogleWithImg('London')`
- `StaticMap::Google('London', ['with' => 600, 'height' => 500, 'mapType' => 'hybrid']])`