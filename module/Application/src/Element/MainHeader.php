<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Decorator\AbstractPageDecorator;
use Application\Config\Color;
use Application\Element\MainHeaderFullName;
use Application\Element\MainHeaderSpeciality;
use Application\Element\MainHeaderFlags;
use Application\Element\MainHeaderDownload;
use Application\Element\MainHeaderIcons;
use Application\Element\MainHeaderMostRecentInfo;
use Application\Element\MainHeaderBackground;
use Application\Element\MainHeaderPersonalData;

class MainHeader extends AbstractPageDecorator
{
    const CURSOR_X = 0;
    const CURSOR_Y = 0;
    
    const LINE_WIDTH = 0.1;
    
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        return $this->renderMainHeader();
    }
    
    /**
     * Creates Main CV Header
     */
    private function renderMainHeader()
    {
        $this->configure();
        
        $this->renderBackground();
        $this->renderTitle();
        $this->renderFlags();
        $this->renderDownloadButton();
        $this->renderContactData();
        $this->renderPersonalPhoto();
        $this->renderMostRecentInfo();
        $this->renderPersonalData();
        
        return $this->tcpdf;
    }
    
    /**
     * Configures header element
     */
    private function configure()
    {
        $this->tcpdf->SetXY(
            self::CURSOR_X,
            self::CURSOR_Y
        );
        
        $this->tcpdf->SetLineWidth(
            self::LINE_WIDTH
        );
        
        $this->tcpdf->SetDrawColor(
            Color::DRAW_COLOR_BRIGHT_RED,
            Color::DRAW_COLOR_BRIGHT_GREEN,
            Color::DRAW_COLOR_BRIGHT_BLUE
        );
    }
    
    /**
     * Renders header background
     */
    private function renderBackground()
    {
        $mainHeaderBackground = new MainHeaderBackground($this->tcpdf);
        $mainHeaderBackground->renderBackground();
    }
    
    /**
     * Renders CV title
     */
    private function renderTitle()
    {
        $mainHeaderFullName = new MainHeaderFullName($this->tcpdf);
        $mainHeaderFullName->renderTitle();
        
        $mainHeaderSpeciality = new MainHeaderSpeciality($this->tcpdf);
        $mainHeaderSpeciality->renderSpeciality();
        
        $MainHeaderTools = new MainHeaderTools($this->tcpdf);
        $MainHeaderTools->renderTools();
    }

    /**
     * Renders flags / cv languages & urls
     */
    private function renderFlags()
    {
        $mainHeaderFlags = new MainHeaderFlags($this->tcpdf);
        $mainHeaderFlags->renderFlags();
    }
    
    /**
     * Renders download button
     */
    private function renderDownloadButton()
    {
        $mainHeaderDownload = new MainHeaderDownload($this->tcpdf);
        $mainHeaderDownload->renderDownloadButton();
    }
    
    /**
     * Renders contact icons
     */
    private function renderContactData()
    {
        $mainHeaderIcons = new MainHeaderIcons($this->tcpdf);
        $mainHeaderIcons->renderContactData();
    }
    
    /**
     * Renders personal photo in header
     */
    private function renderPersonalPhoto()
    {
        $mainHeaderPersonalPhoto = new MainHeaderPersonalPhoto($this->tcpdf);
        $mainHeaderPersonalPhoto->renderPersonalPhoto();
    }
    
    /**
     * Renders information about most recent CV
     */
    private function renderMostRecentInfo()
    {
        $mainHeaderMostRecentInfo = new MainHeaderMostRecentInfo($this->tcpdf);
        $mainHeaderMostRecentInfo->renderMostRecentInfo();
    }
    
    /**
     * Renders personal data column
     */
    private function renderPersonalData()
    {
        $mainHeaderPersonalData = new MainHeaderPersonalData($this->tcpdf);
        $mainHeaderPersonalData->renderPersonalData();
    }
}