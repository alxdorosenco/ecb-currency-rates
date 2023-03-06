# Ecb currency rates

[![Latest Stable Version](http://poser.pugx.org/alxdorosenco/ecb-rates/v)](https://packagist.org/packages/alxdorosenco/ecb-rates) [![Total Downloads](http://poser.pugx.org/alxdorosenco/ecb-rates/downloads)](https://packagist.org/packages/alxdorosenco/ecb-rates) [![Latest Unstable Version](http://poser.pugx.org/alxdorosenco/ecb-rates/v/unstable)](https://packagist.org/packages/alxdorosenco/ecb-rates) [![License](http://poser.pugx.org/alxdorosenco/ecb-rates/license)](https://packagist.org/packages/alxdorosenco/ecb-rates) [![PHP Version Require](http://poser.pugx.org/alxdorosenco/ecb-rates/require/php)](https://packagist.org/packages/alxdorosenco/ecb-rates)

Currency rate convertor from European Central Bank

Url to the latest rate attributes:   https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml

Url to the archived rate attributes: https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist.xml

## Installation
Require this package with Composer

```bash
$ composer require alxdorosenco/ecb-rates
```

## Usage

### Latest rate attributes

```php
<?php

require __DIR__ . '/vendor/autoload.php';
use AlxDorosenco\EcbRates\CurrencyRates;

// Latest rate attributes initialization
$daily = CurrencyRates::daily();

// Exchange 20 EUR to USD
$daily->rate(20, 'EUR', 'USD');

// Exchange 20 EUR to USD - special option
$daily->euroTo(20, 'USD');

// Exchange 20 USD to JPY
$daily->rate(20, 'USD', 'JPY');

```

### History rate attributes

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use AlxDorosenco\EcbRates\CurrencyRates;

$history = CurrencyRates::history(); // History rate attributes initialization

// Get array of the rate attributes to the 2021-02-10 date
$history->findByDate('2021-02-10');

// Exchange 20 EUR to USD from the rate attributes to the 2021-02-10 date
$history->findByDate('2021-02-10')->rate(20, 'EUR', 'USD');

// Exchange 20 EUR to USD from the rate attributes to the 2021-02-10 date - special option
$history->findByDate('2021-02-10')->euroTo(20, 'EUR', 'USD');

// Get array of the latest rate attributes
$history->findByDate();  

// Exchange 20 EUR to USD from the latest rate attributes
$history->rate(20, 'EUR', 'USD');

// Exchange 20 EUR to USD from the latest rate attributes - special option
$history->rate(20, 'EUR', 'USD')->euroTo(20, 'EUR', 'USD');

```

All possible currency codes:
* USD
* JPY
* BGN
* CZK
* DKK
* GBP
* HUF
* PLN
* RON
* SEK
* CHF
* ISK
* NOK
* HRK
* RUB
* TRY
* AUD
* BRL
* CAD
* CNY
* HKD
* IDR
* ILS
* INR
* KRW
* MXN
* MYR
* NZD
* PHP
* SGD
* THB
* ZAR
