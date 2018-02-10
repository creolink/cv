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
        return $this->renderPDF();
    }

    /**
     * @return Response
     */
    public function downloadAction(): Response
    {
        return $this->renderPDF(true);
    }

    /**
     * Home page - auto redirect to english site
     *
     * @return Response
     */
    public function homeAction(): Response
    {
        return $this->redirect()->toRoute(
            'language',
            [Locale::ROUTER_LANGUAGE_PARAM => Locale::DEFAULT_LANGUAGE]
        );
    }

    /**
     * @param bool $isAttachement
     * @return Response
     */
    private function renderPDF(bool $isAttachement = false): Response
    {
        $pdf = $this->getPdf();

        $this->setHeaders(
            $this->getPdfHeaders($pdf, $isAttachement)
        );

        $this->getResponse()
            ->setContent($pdf);

        return $this->response;
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
     * @param array $pdfHeaders
     */
    private function setHeaders(array $pdfHeaders)
    {
        $headers = new Headers();
        $headers->clearHeaders();
        $headers->addHeaders($pdfHeaders);

        $this->getResponse()->setHeaders(
            $headers
        );
    }

    /**
     * @param string $pdf
     * @param bool $isAttachment
     * @return array
     */
    private function getPdfHeaders(string $pdf, bool $isAttachment = false): array
    {
        $contentDisposition = $isAttachment ? 'attachment' : 'inline';

        $headers = [
            'Content-type' => 'application/pdf',
            'Cache-Control' => 'private, must-revalidate, post-check=0, pre-check=0, max-age=1',
            'Pragma' => 'public',
            'Expires' => 'Sat, 26 Jul 1997 05:00:00 GMT',
            'Last-Modified' => gmdate('D, d M Y H:i:s').' GMT',
            'Content-Disposition' => $contentDisposition . '; filename="' . $this->getFileName(). '"',
            'Content-Length' => strlen($pdf),
        ];

        if (true === $isAttachment) {
            $headers['Content-Transfer-Encoding'] = 'binary';
        }

        return $headers;
    }

    /**
     * @return string
     */
    private function getFileName(): string
    {
        return basename(
            sprintf(
                PdfConfig::FILE_NAME,
                $this->params()->fromRoute(
                    Locale::ROUTER_LANGUAGE_PARAM,
                    Locale::DEFAULT_LANGUAGE
                )
            )
        );
    }
}
