<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Model;

interface PdfConfig
{
    const PATH_FONTS = 'public/fonts/unifont/';
    const PATH_IMAGES = 'public/images/';
    
    const DOCUMENT_KEYWORDS = 'Jakub Luczynski, CV, web developer, php, specialist, project manager';
    const DOCUMENT_TITLE = 'Jakub Luczynski, Curriculum Vitae';
    const DOCUMENT_AUTHOR = 'Jakub Luczynski';
    
    const DOCUMENT_CREATOR = 'Jakub Luczynski, powered by TCPDF';
    
    const DOCUMENT_URL = 'http://cv.creolink.pl';
}
