<?php
/**
 * ecb-rates
 * TCurrency.php
 *
 * @author   Alexei Dorosenco
 * @category Production
 * @package  Default
 * @date     07.03.2021 12:48
 * @license  https://github.com/alxdorosenco/ecb-rates/LICENSE ecb-rates License
 * @version  GIT: 1.0
 * @link     https://github.com/alxdorosenco/ecb-rates
 */

namespace AlxDorosenco\EcbRates;

/**
 * Class Currency
 * @package AlxDorosenco\EcbRates
 */
trait TCurrency
{
    /**
     * @var array
     */
    private $attributes = [];

    /**
     * Get current date
     *
     * @return mixed
     */
    public function time()
    {
        return $this->attributes['time'] ?? null;
    }

    /**
     * Get cost of the current rate attributes
     *
     * @return array|mixed
     */
    public function cost(string $currency) : float
    {
        return $this->attributes['rates'][$currency] ?? reset($this->attributes)['rates'][$currency] ?? 0;
    }

    /**
     * Get array of the current rate attributes
     *
     * @return array
     */
    public function attributes()
    {
        return $this->attributes;
    }

    /**
     * Convert price to the necessary currency
     *
     * @param float $price
     * @param string $from
     * @param string $to
     * @param int $decimals
     * @return float
     * @throws \Exception
     */
    public function rate(float $price, string $from, string $to, int $decimals = 2) : float
    {
        if($from === $to){
            return 0;
        }

        if(($from !== 'EUR' && !$this->cost($from)) || ($to !== 'EUR' && !$this->cost($to))){
            return 0;
        }

        if($from === 'EUR'){
            $result = $price * $this->cost($to);
        }

        if($to === 'EUR'){
            $result = $price / $this->cost($from);
        }

        if($from !== 'EUR' && $to !== 'EUR'){
            $result = $price / $this->cost($from) * $this->cost($to);
        }

        return (float)number_format($result, $decimals, '.', '');
    }

    /**
     * Convert price from euro to the necessary currency
     *
     * @param float $price
     * @param string $to
     * @param int $decimals
     * @return float
     * @throws \Exception
     */
    public function euroTo(float $price, string $to, int $decimals = 2) : float
    {
        if($to === 'EUR'){
            return 0;
        }

        return (float)number_format($price * $this->cost($to), $decimals, '.', '');
    }
}
