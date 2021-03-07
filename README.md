# ecb-rates
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

// Convert EUR to USD
$daily->rate(20, 'EUR', 'USD');

// Convert EUR to USD - special option
$daily->euroTo(20, 'USD');

// Convert USD to JPY
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

// Convert EUR to USD from the rate attributes to the 2021-02-10 date
$history->findByDate('2021-02-10')->rate(20, 'EUR', 'USD');

// Convert EUR to USD from the rate attributes to the 2021-02-10 date - special option
$history->findByDate('2021-02-10')->euroTo(20, 'EUR', 'USD');

// Get array of the latest rate attributes
$history->findByDate();  

// Convert EUR to USD from the latest rate attributes
$history->rate('EUR', 'USD');

// Convert EUR to USD from the latest rate attributes - special option
$history->rate('EUR', 'USD')->euroTo(20, 'EUR', 'USD');

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
