<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Normalization;

use \IntlDateFormatter;
use Application\I18n\LocalizationService;
use Zend\I18n\View\Helper\DateFormat;

class NormalizedDateService
{
    /**
     * @var LocalizationService
     */
    private $localizationService;
    
    /**
     * @var IntlDateFormatter
     */
    private $formatter;
    
    public function __construct(
        LocalizationService $localizationService
    ) {
        $this->localizationService = $localizationService;
    }
    
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
     * @param  DateTime|int|array $date
     * @return string
     */
    public function getTransformedDate($date)
    {
        $this->formatter->setPattern('d MMMM yyyy');
        
        return $this->formatter->format($date);
    }
}
