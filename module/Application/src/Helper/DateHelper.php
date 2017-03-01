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
     * @param string $date
     * @return string
     */
    public static function getDate($date)
    {
        $currentLocale = setlocale(LC_TIME, "0");

        $formatedDate = strftime(
            "%d %B %Y",
            strtotime($date)
        );

        if (strpos($currentLocale, 'pl_PL') !== false) {
            return self::getPolishMonths(
                $date,
                $formatedDate
            );
        }

        return $formatedDate;
    }

    /**
     * @param int $year
     * @return int
     */
    public static function getPassedYears($year)
    {
        return date("Y") - $year;
    }

    /**
     * @param int $date
     * @param string $formatedDate
     * @return string
     */
    private static function getPolishMonths($date, $formatedDate = '')
    {
        $month = date("n", $date);
        $monthNames = $this->polishMonths[$month];

        return str_replace(
            $monthNames[0],
            $monthNames[1],
            $formatedDate
        );
    }
}
