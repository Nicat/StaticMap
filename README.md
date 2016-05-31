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

If you need to modify the Static Map partials, you can run:

```bash
php artisan vendor:publish
```

## Usage

Within your controllers

```php
StaticMap::Google('London')
```

You may also do:

- `StaticMap::Google('London')`
- `StaticMap::Google('37.6213129,-122.3811441')`
- `StaticMap::GoogleWithImg('London')`
- `StaticMap::Google('London', ['with' => 600, 'height' => 500, 'mapType' => 'hybrid'])`

You can modify partials

```php
    'width'       => 600, // Width of Map image
    'height'      => 400, // Height of Map Image
    'mapType'     => 'roadmap', // Map type ['roadmap', 'terrain', 'satellite', 'hyrid']
    'imageFormat' => 'png', // gif, png or jpg
    'zoom'        => 14, // Zoom of Map
```

You may also can add markers:


```php
{!! StaticMap::GoogleWithImg('London', ['markers' => ['center' => 'Westminster London', 'label' => '2'], 'imageType' => 'gif'])
```

If you want just add marker of main center

```php
{!! StaticMap::GoogleWithImg('37.6213129,-122.3811441', ['markers' => true]) !!}
```


Marker options
```php
    'center'  => '37.6213129,-122.3811441', // or 'San Francisco International Airport'
    'label'   => '1', // Label Name of Marker
    'color'   => '0xff0000', //  color of marker   
    'size'    => 'mid', // tiny (Small),small (Medium), mid (Large)
```


##Some examples

```php
{!! StaticMap::GoogleWithImg('San Francisco International Airport', ['markers' => [
                ['center' => 'San Bruno', 'label' => '2'],
                ['center' => '37.6213129,-122.3711441', 'label' => '1']
            ]
        ]) !!}
```

![http://s33.postimg.org/40tfyv5a7/image.png](http://s33.postimg.org/40tfyv5a7/image.png)

```php
{!! StaticMap::GoogleWithImg('37.6213129,-122.3811441', ['with' => 600, 'height' => 500, 'mapType' => 'hybrid']) !!}
```

![http://s33.postimg.org/5m1es88zj/image.png](http://s33.postimg.org/5m1es88zj/image.png)