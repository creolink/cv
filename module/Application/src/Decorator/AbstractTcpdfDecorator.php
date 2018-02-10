<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Decorator;

use Application\Model\CurriculumVitae;
use Application\Decorator\TcpdfDecoratorInterface;
use Application\Model\TcpdfInterface;
use \DateTime;

abstract class AbstractTcpdfDecorator implements TcpdfDecoratorInterface
{
    /**
     * @var CurriculumVitae|TcpdfInterface $tcpdf
     */
    protected $tcpdf;

    /**
     * @var type
     */
    protected $isDownloaded = false;

    /**
     * @param TcpdfInterface $tcpdf
     */
    public function __construct(TcpdfInterface $tcpdf)
    {
        $this->tcpdf = $tcpdf;
    }

    /**
     * @param string $message
     * @return string
     */
    protected function trans(string $message): string
    {
        return $this->tcpdf->getTranslator()
            ->translate($message);
    }

    /**
     * @param DateTime|int|array|string $date
     * @return string
     */
    protected function localizeDate(DateTime $date): string
    {
        return $this->tcpdf->getDateService()
            ->getLocalizedDate($date);
    }

    /**
     * @param DateTime|int|array|string $date
     * @return string
     */
    protected function localizeMonthAndYear(DateTime $date): string
    {
        return $this->tcpdf->getDateService()
            ->getMonthAndYear($date);
    }

    /**
     * @return string
     */
    protected function getCustomizationUrl(): string
    {
        $customization = $this->tcpdf->getTranslator()
                    ->getCustomizedCompany();

        return !empty($customization) ? '/' . $customization : '';
    }
}
