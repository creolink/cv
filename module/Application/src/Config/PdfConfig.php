<?php
/**
 * @copyright 2015-2017 Jakub Łuczyński
 * @author Jakub Łuczyński <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Config;

class PdfConfig
{
    const PATH_FONTS = 'public/fonts/unifont/';
    const PATH_IMAGES = 'public/images/';

    const DOCUMENT_KEYWORDS = 'Jakub Łuczyński, CV, web developer, php, specialist, project manager';
    const DOCUMENT_TITLE = 'Jakub Łuczyński, Curriculum Vitae';
    const DOCUMENT_AUTHOR = 'Jakub Łuczyński';
    const DOCUMENT_CREATOR = 'Jakub Łuczyński, powered by TCPDF';
    const DOCUMENT_URL = 'http://cv.creolink.pl';

    const FILE_NAME = 'jakub.luczynski.cv.pdf';
}
