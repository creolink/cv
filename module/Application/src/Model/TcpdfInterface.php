<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Model;

interface TcpdfInterface
{
    const NEW_LINE = "\r\n";
    
    const BORDER_NONE = 0;
    
    const ALIGN_LEFT = 'L';
    const ALIGN_CENTER = 'C';
    const ALIGN_RIGHT = 'R';
    
    const NOT_FILLED = false;
    
    const CELL_LINE_NONE = 0;
    
    /**
     * return TcpdfInterface
     */
    public function addElements();
}
