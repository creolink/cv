<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Decorator;

interface TcpdfDecoratorInterface
{
    const ENCODING = 'UTF-8';

    const NEW_LINE = "\r\n";

    const BORDER_NONE = 0;

    const ALIGN_LEFT = 'L';
    const ALIGN_CENTER = 'C';
    const ALIGN_RIGHT = 'R';

    const TRANSPARENT = false;

    const CELL_LINE_NONE = 0;
}
