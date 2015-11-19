# PHP Envato Api


[![Software License](https://img.shields.io/badge/licence-%20GNU%20General%20Public%20License%20v3.0-brightgreen.svg)](LICENSE.md)
![](https://img.shields.io/badge/version-1.0.0-brightgreen.svg)

A complete native php wrapper for the [Envato API](https://build.envato.com/)

## Install

Via Composer

``` bash
$ composer require morningtrain/envato-api
```

## Usage

``` php
require 'vendor/autoload.php';
use MorningTrain\EnvatoApi\EnvatoApi;

define('ENVATO_TOKEN', 'YOUR-ENVATO-API-TOKEN');

$envatoClient = new EnvatoApi(ENVATO_TOKEN);
$sales = $envatoClient->getAuthorSales(0);
```

## Security

If you discover any security related issues, please email mail@morningtrain.dk instead of using the issue tracker.

## Credits

- [morningtrain.dk](http://morningtrain.dk/)
- [Mohamed Bouallegue](https://github.com/MohamedBoualleg)

## License

 GNU General Public License v3.0. Please see [License File](LICENSE.md) for more information.
