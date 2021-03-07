<?php
/**
 * ecb-rates
 * CurrencyRatesTest.php
 *
 * @author   Alexei Dorosenco
 * @category Production
 * @package  Default
 * @date     07.03.2021 22:38
 * @license  https://github.com/alxdorosenco/ecb-rates/LICENSE ecb-rates License
 * @version  GIT: 1.0
 * @link     https://github.com/alxdorosenco/ecb-rates
 */

use AlxDorosenco\EcbRates\Ecb;
use AlxDorosenco\EcbRates\CurrencyRates;
use PHPUnit\Framework\TestCase;

/**
 * Class CurrencyRatesTest
 */
class CurrencyRatesTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testInitialize(Ecb $currencyRates)
    {
        $this->assertNotEmpty($currencyRates->attributes());
        $this->assertIsArray($currencyRates->attributes());
    }

    /**
     * @dataProvider provider
     */
    public function testRate(Ecb $currencyRates)
    {
        $this->assertEmpty($currencyRates->rate(20,'EUR','EUR'));
        $this->assertEmpty($currencyRates->rate(20,'Something wrong','EUR'));
        $this->assertEmpty($currencyRates->rate(20,'EUR','Something wrong'));

        $this->assertNotEmpty($currencyRates->rate(20,'EUR','USD'));
        $this->assertNotEmpty($currencyRates->rate(20,'USD','JPY'));
        $this->assertNotEmpty($currencyRates->euroTo(20,'USD'));
    }

    /**
     * @throws Exception
     */
    public function testFindByDate()
    {
        $this->assertNotEmpty(CurrencyRates::history()->findByDate('2021-02-10'));

        $this->assertIsNumeric(CurrencyRates::history()->findByDate('2021-02-10')->rate(20,'EUR','USD'));
        $this->assertIsNumeric(CurrencyRates::history()->findByDate('2021-02-10')->euroTo(20,'USD'));

        $this->assertEquals(CurrencyRates::history()->rate(20,'EUR','USD'), CurrencyRates::history()->findByDate()->rate(20,'EUR','USD'));
        $this->assertEquals(CurrencyRates::history()->euroTo(20,'USD'), CurrencyRates::history()->findByDate()->euroTo(20,'USD'));
    }

    /**
     * @return array[]
     */
    public function provider()
    {
        return [
            [CurrencyRates::daily(), CurrencyRates::history()]
        ];
    }
}
