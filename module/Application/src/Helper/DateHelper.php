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
        1 => ['styczeń', 'stycznia'],
        2 => ['luty', 'lutego'],
        3 => ['marzec', 'marca'],
        4 => ['kwiecień', 'kwietnia'],
        5 => ['maj', 'maja'],
        6 => ['czerwiec', 'czerwca'],
        7 => ['lipiec', 'lipca'],
        8 => ['sierpień', 'sierpnia'],
        9 => ['wrzesień', 'wrzesnia'],
        10 => ['październik', 'października'],
        11 => ['listopad', 'listopada'],
        12 => ['grudzień', 'grudnia'],
    ];

    /**
     * @param string $date
     * @return string
     */
    public static function getDate(string $date): string
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
    public static function getPassedYears(int $year): int
    {
        return date("Y") - $year;
    }

    /**
     * @param int $date
     * @param string $formatedDate
     * @return string
     */
    private static function getPolishMonths(int $date, string $formatedDate = ''): string
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
