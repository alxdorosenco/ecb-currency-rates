<?php
/**
 * ecb-rates
 * TCurrency.php
 *
 * @author   Alexei Dorosenco
 * @category Production
 * @package  Default
 * @date     07.03.2021 12:03
 * @license  https://github.com/alxdorosenco/ecb-rates/LICENSE ecb-rates License
 * @version  GIT: 1.0
 * @link     https://github.com/alxdorosenco/ecb-rates
 */

namespace AlxDorosenco\EcbRates;

/**
 * European Central Bank global class
 *
 * Class Ecb
 * @package AlxDorosenco\EcbRates
 */
abstract class Ecb
{
    /**
     * @var string
     */
    protected $url;

    /**
     * Ecb constructor.
     */
    abstract public function __construct();

    /**
     * Parse and convert xml to array
     *
     * @return array
     * @throws \JsonException
     */
    protected function parseXmlToArray(): array
    {
        $xml = simpleXML_load_file($this->url);               // parse xml file
        $xml = json_encode($xml, JSON_THROW_ON_ERROR);  // convert xml to json

        // convert json to array
        return json_decode($xml, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param float $price
     * @param string $from
     * @param string $to
     * @param int $decimals
     * @return mixed
     */
    abstract public function rate(float $price, string $from, string $to, int $decimals = 2) : float;

    /**
     * @param float $price
     * @param string $to
     * @param int $decimals
     * @return mixed
     */
    abstract public function euroTo(float $price, string $to, int $decimals = 2) : float;
}
