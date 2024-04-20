<?php
/**
 * ecb-rates
 * EcbRateHistory.php
 *
 * @author   Alexei Dorosenco
 * @category Production
 * @package  Default
 * @date     07.03.2021 12:16
 * @license  https://github.com/alxdorosenco/ecb-rates/LICENSE ecb-rates License
 * @version  GIT: 1.0
 * @link     https://github.com/alxdorosenco/ecb-rates
 */

namespace AlxDorosenco\EcbRates;

use function PHPUnit\Framework\throwException;

/**
 * Archived reference rates
 *
 * Class EcbRateHistory
 * @package AlxDorosenco\EcbRates
 */
class EcbRateHistory extends Ecb
{
    use TCurrency;

    /**
     * Url to the archived rates
     */
    protected $url = 'https://www.ecb.europa.eu/stats/eurofxref/eurofxref-hist.xml';

    /**
     * @var array
     */
    protected array $parsedAttributes = [];

    /**
     * Build readable array with the rate attributes
     *
     * EcbRateHistory constructor.
     */
    public function __construct()
    {
        $xmlArray = $this->parseXmlToArray();

        foreach ($xmlArray['Cube'] ?? [] as $children){
            foreach ($children as $k => $child){
                if(!empty($child['@attributes']['time'])){
                    $this->parsedAttributes[$k]['time'] = $child['@attributes']['time'];

                    foreach ($child['Cube'] ?? [] as $node){
                        if(!empty($node['@attributes'])){
                            $this->parsedAttributes[$k]['rates'][$node['@attributes']['currency']] = $node['@attributes']['rate'];
                        }
                    }
                }
            }
        }
    }

    /**
     * Extract rate attributes by date
     * If the date does not exist we force set latest attributes
     *
     * @param string|null $date
     * @return $this
     * @throws \Exception
     */
    public function findByDate(string $date = null) : EcbRateHistory
    {
        if(!$date){
            !$this->parsedAttributes ?: $this->parsedAttributes = reset($this->parsedAttributes);

            return $this;
        }

        $foundKey = array_search($date, array_column($this->parsedAttributes, 'time'), true);

        if(!$foundKey) {
            throw new \Exception('Information did not found from the '.$date.' date');
        }

        $this->attributes = $this->parsedAttributes[$foundKey];

        return $this;
    }
}
