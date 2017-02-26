<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Normalization;

use \IntlDateFormatter;
use Application\I18n\LocalizationService;
use \DateTime;

class NormalizedDateService
{
    const LOCALIZED_DATE_PATTERN = 'd MMMM yyyy';
    const LOCALIZED_MONTH_AND_YEAR = 'LLLL yyyy';
    
    /**
     * @var LocalizationService
     */
    private $localizationService;
    
    /**
     * @var IntlDateFormatter
     */
    private $formatter;
    
    /**
     * @param LocalizationService $localizationService
     */
    public function __construct(
        LocalizationService $localizationService
    ) {
        $this->localizationService = $localizationService;
    }
    
    /**
     * Sets formatter
     */
    public function setFormatter()
    {
        $this->formatter = new IntlDateFormatter(
            $this->localizationService->getLocale(),
            IntlDateFormatter::FULL,
            IntlDateFormatter::FULL
        );
    }
    
    /**
     * Returns localized date with properly transformed month name
     * 
     * @param  DateTime|int|array|string $date
     * @return string
     */
    public function getLocalizedDate($date)
    {
        return $this->format(
            self::LOCALIZED_DATE_PATTERN,
            $date
        );
    }
    
    /**
     * Returns localized month and year
     * 
     * @param  DateTime|int|array|string $date
     * @return string
     */
    public function getMonthAndYear($date)
    {
        return $this->format(
            self::LOCALIZED_MONTH_AND_YEAR,
            $date
        );
    }
    
    /**
     * @param  DateTime|int|array|string $date
     * @return DateTime|int|array
     */
    private function createDate($date)
    {
        if (gettype($date) === 'string') {
            $date = new DateTime($date);
        }
        
        return $date;
    }
    
    /**
     * @param string $pattern
     * @param DateTime|int|array $date
     * @return string
     */
    private function format($pattern, $date)
    {
        $this->formatter->setPattern($pattern);
        
        return $this->formatter->format(
            $this->createDate($date)
        );
    }
}
