<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Config\Image;
use Application\Decorator\AbstractTcpdfDecorator;

class MainHeaderDownload extends AbstractTcpdfDecorator
{
    const DOWNLOAD_CURSOR_X = 12;
    const DOWNLOAD_CURSOR_Y = 18;

    /**
     * Renders download button
     */
    public function renderDownloadButton()
    {
        if (false === $this->isDownloaded) {
            $this->tcpdf->renderImage(
                Image::DOWNLOAD,
                self::DOWNLOAD_CURSOR_X,
                self::DOWNLOAD_CURSOR_Y,
                Image::DOWNLOAD_WIDTH,
                Image::DOWNLOAD_HEIGHT,
                'http://'.$_SERVER['HTTP_HOST'].'/download'
            );
        }
    }
}
