<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Helper;

class DateHelper
{
    /**
     * @var int
     */
    private $date = 0;
    
    /**
     * @var array
     */
    private $polishMonths = [
        1 => array('styczeń', 'stycznia'),
        2 => array('luty', 'lutego'),
        3 => array('marzec', 'marca'),
        4 => array('kwiecień', 'kwietnia'),
        5 => array('maj', 'maja'),
        6 => array('czerwiec', 'czerwca'),
        7 => array('lipiec', 'lipca'),
        8 => array('sierpień', 'sierpnia'),
        9 => array('wrzesień', 'wrzesnia'),
        10 => array('październik', 'października'),
        11 => array('listopad', 'listopada'),
        12 => array('grudzień', 'grudnia'),
    ];
    
    /**
     * @param int $date
     */
    public function __construct($date)
    {
        $this->date = $date;
    }
    
    /**
     * @return string
     */
    public function getDate()
    {
        $currentLocale = setlocale(LC_TIME, "0");
        
        $formatedDate = strftime("%d %B %Y", $this->date);
        
        if (strpos($currentLocale, 'pl_PL') !== false) {
            return $this->getPolishMonths($formatedDate);
        }
        
        return $formatedDate;
    }
    
    /**
     * @param string $date
     * @return string
     */
    private function getPolishMonths($date = '')
    {
        $month = date("n", $this->date);
        $monthNames = $this->polishMonths[$month];
        
        return str_replace($monthNames[0], $monthNames[1], $date);
    }
}

