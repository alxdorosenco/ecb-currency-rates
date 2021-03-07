<?php
/**
 * ecb-rates
 * CurrencyRates.php
 *
 * @author   Alexei Dorosenco
 * @category Production
 * @package  Default
 * @date     07.03.2021 12:57
 * @license  https://github.com/alxdorosenco/ecb-rates/LICENSE ecb-rates License
 * @version  GIT: 1.0
 * @link     https://github.com/alxdorosenco/ecb-rates
 */

namespace AlxDorosenco\EcbRates;

/**
 * Class CurrencyRates
 * @package AlxDorosenco\EcbRates
 */
final class CurrencyRates
{
    /**
     * EcbRateDaily initialization
     *
     * @return EcbRateDaily
     */
    public static function daily() : EcbRateDaily
    {
        return new EcbRateDaily();
    }

    /**
     * EcbRateHistory initialization
     *
     * @return EcbRateHistory
     */
    public static function history() : EcbRateHistory
    {
        return new EcbRateHistory();
    }
}
