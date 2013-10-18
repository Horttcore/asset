Asset Component
==============

* [Installation](#installation)
* [Configuration](#configuration)

`Orchestra\Asset` is a port of Laravel 3 Asset for Orchestra Platform.

## Installation

To install through composer, simply put the following in your `composer.json` file:

```json
{
	"require": {
		"orchestra/asset": "2.1.*@dev"
	}
}
```

## Configuration

Next add the service provider in `app/config/app.php`.

```php
'providers' => array(
	
	// ...
	
	'Orchestra\Asset\AssetServiceProvider',
),
```

You might want to add `Orchestra\Support\Facades\Asset` to class aliases in `app/config/app.php`:

```php
'aliases' => array(

	// ...

	'Asset' => 'Orchestra\Support\Facades\Asset',
),
```