<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 * @version 2.0.1
 */

namespace Application\Controller;

use Application\Controller\BaseController;
use Application\Config\PdfConfig;
use Application\Config\Locale;
use Zend\Http\Response;
use Zend\Http\Headers;

class IndexController extends BaseController
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $pdf = $this->getPdf();

        $this->setHeaders($pdf);

        $this->getResponse()
            ->setContent($pdf);

        return $this->response;
    }

    /**
     * Home page - auto redirect to english site
     *
     * @return Response
     */
    public function homeAction(): Response
    {
        return $this->redirect()->toRoute(
            'subdomain',
            ['locale' => Locale::DEFAULT_ROUTED_LOCALE]
        );
    }

    /**
     * @return string
     */
    private function getPdf(): string
    {
        return $this->getCurriculumVitae()
            ->build()
            ->render();
    }

    /**
     * Sets headers
     *
     * @param string $pdf
     */
    private function setHeaders(string $pdf)
    {
        $headers = new Headers();
        $headers->clearHeaders();
        $headers->addHeaders(
            $this->getPdfHeaders($pdf)
        );

        $this->getResponse()->setHeaders(
            $headers
        );
    }

    /**
     * @param string $pdf
     * @return array
     */
    private function getPdfHeaders(string $pdf): array
    {
        return [
            'Content-type' => 'application/pdf',
            'Cache-Control' => 'private, must-revalidate, post-check=0, pre-check=0, max-age=1',
            'Pragma' => 'public',
            'Expires' => 'Sat, 26 Jul 1997 05:00:00 GMT',
            'Last-Modified' => gmdate('D, d M Y H:i:s').' GMT',
            'Content-Disposition' => 'inline; filename="' . basename(PdfConfig::FILE_NAME). '"',
            'Content-Length' => strlen($pdf),
        ];
    }
}
