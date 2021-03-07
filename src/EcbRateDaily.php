<?php
/**
 * ecb-rates
 * EcbRateDaily.php
 *
 * @author   Alexei Dorosenco
 * @category Production
 * @package  Default
 * @date     07.03.2021 12:09
 * @license  https://github.com/alxdorosenco/ecb-rates/LICENSE ecb-rates License
 * @version  GIT: 1.0
 * @link     https://github.com/alxdorosenco/ecb-rates
 */

namespace AlxDorosenco\EcbRates;

/**
 * Latest reference rates
 *
 * Class EcbRateDaily
 * @package AlxDorosenco\EcbRates
 */
class EcbRateDaily extends Ecb
{
    use TCurrency;

    /**
     * Url to the latest rates
     */
    protected $url = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

    /**
     * Build readable array with the rate attributes
     *
     * EcbRateDaily constructor.
     */
    public function __construct()
    {
        $xmlArray = $this->parseXmlToArray();

        foreach ($xmlArray['Cube'] ?? [] as $k => $child){
            if(!empty($child['@attributes']['time'])){
                $this->attributes['time'] = $child['@attributes']['time'];

                foreach ($child['Cube'] ?? [] as $node){
                    if(!empty($node['@attributes'])){
                        $this->attributes['rates'][$node['@attributes']['currency']] = $node['@attributes']['rate'];
                    }
                }
            }
        }
    }
}
