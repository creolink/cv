<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractEmployment;

class CommisionedJobs extends AbstractEmployment
{
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        $this->tcpdf = $this->tcpdf->addElements();
        
        return $this->renderCommisionedJobs();
    }
    
    private function renderCommisionedJobs()
    {
        $x = 5;
        $y = 14;
        
        $this->renderBlockTitle('Additional, commisioned & freelance jobs', $x, $y, 200, 27.5);
        
        $step = 4;
        
        $x = $this->tcpdf->cursorPositionX;
        $y = $this->tcpdf->cursorPositionY;
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'May 2013 - July 2016',
            'System Designer & Main PHP Coder / B2E & B2C project',
            'TPnets.com - Tomasz Bathelt, Piotr Marciniak',
            'Piotrkowska 148/150, 90-063, Lodz, Poland',
            'Design and development of dedicated, proprietary B2E & B2C system for ISP (network & VoIP management, customer relationship management, electronic customer office, automatic invoicing, reporting). Coding with MySQL, PHP5, JavaScript (jQuery, Ajax), CSS, HTML5 basing on my own, MVC framework and template system. Online, remote work. Long-term cooperation. Development and modernization of application. Technical supervision.',
            'http://cv.creolink.pl/examples/tpnets.zip',
            'http://cv.creolink.pl/references/references_tpnets.zip',
            'Piotr Marciniak, +48 42 / 636-98-96',
            'http://tpnets.com/'
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'August 2015',
            'Web Designer / B2C project',
            'Ms. Perfect Anita Luczynska',
            'Am Wall 54, 14532 Kleinmachnow, Deutschland',
            'Design of responsive corporate website for cleaning company. Creation of graphic layout, coding with PHP, Javascript and CSS with Bootstrap library.',
            '',
            '',
            'Anita Luczynska, +49 163 8248005',
            'http://www.msperfect.de/'
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'February 2013 - July 2015',
            'Software designer / B2C & B2E, eCommerce project',
            'Freepers Spolka Cywilna',
            'Pomorska 41, 90-203, Lodz, Poland',
            'Design and development of dedicated, proprietary application of eCommerce system with CMS and CRM modules. Comprehensive implementation of solution with server based on Linux, Nginx, Percona Server and my own fast and flexible framework based on MVC, PHP5 OOP, MySQL, HTML5, CSS, JS (jQuery), Python. Integration with external systems using SOAP / REST. Advising, coaching. Project documentation.',
            'http://cv.creolink.pl/examples/freepers.zip',
            'http://cv.creolink.pl/references/freepers_en.jpg',
            'Krzysztof Rogalski, +48 42 / 239 41 77, +48 42 / 791 24 95 30',
            'http://fripers.pl/'
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'December 2008 - May 2009',
            'PHP Web Developer / B2C project',
            'Ksiegarnia Internetowa Gandalf (Online Bookstore "Gandalf")',
            'Al. Pilsudskiego 135, 92-318, Lodz, Poland',
            'Brand improvement through implementation of proprietary online shop dedicated for mobile devices. Updates of internal intranet system (CMR / CMS)',
            '',
            '',
            'Anetta Wilczynska, +48 42 / 252 39 23',
            'http://www.gandalf.com.pl'
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'September 2007 - February 2009',
            'Portal Designer & PHP Developer / B2B project',
            'Stawoz sp z o.o.',
            'Al. Pilsudskiego 141, 92-318, Lodz, Poland',
            'Design and implementation of new, dedicated web portals about enviromental, fire and safety subjects: http://www.portal-ppoz.pl/, http://www.portal-bhp.pl/, http://www.portal-ekologia.pl/. Refactoring of http://www.ppozbhp.pl/. Active positioning in search engines like Google, Yahoo, Bing, Infoseek. maintenance, development and supervision of portals. (portals are closed)',
            '',
            'http://cv.creolink.pl/references/references_stawoz.zip',
            'Stanisław Woźnica, +48 42 / 673 57 05, +48 42 / 602 290 306',
            'http://www.stawoz.pl/'
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            '2004 - 2006',
            'PHP Programmer & Web Developer / Freelancer',
            'IIZT.com',
            'Prinseneiland 303, 1013 LP Amsterdam, The Netherlands',
            'Websites development for Dutch group IIZT.com - blogs, content management systems - programming with PHP, MySQL, JavaScript, CSS, HTML/XHTML. Online, remote work.',
            '',
            'http://cv.creolink.pl/references/iizt.jpg',
            'Todd Wilkinson, todd@sacramentomarketinglabs.com',
            'https://www.iizt.com/'
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'August 2004 - April 2005',
            'Web Developer & Designer, PHP Coder / B2E & B2C project',
            'GANDALF Księgarnia Internetowa (Online Bookstore "Gandalf")',
            'Łąkowa 3/5, 90-562, Lodz, Poland',
            'Design, programming and implementation of dedicated, proprietary e-commerce software of Bookstore "Gandalf" - http://www.gandalf.com.pl/. Design and implementation of dedicated intranet system (CMS / CMR) for e-commerce applications. Modernizaton and development of the system. Service and support.',
            '',
            '',
            'Anetta Wilczynska, +48 42 / 252 39 23',
            'http://www.gandalf.com.pl'
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'November 2003 - June 2005',
            'Portal Designer & PHP Developer / B2B project',
            'Stawoz sp z o.o.',
            'Al. Pilsudskiego 141, 92-318, Lodz, Poland',
            'Design and creation of proprietary system of web portals with CMS about enviromental, fire and safety subjects (using PHP, MySQL, XHTML, CSS, JS). Active positioning in Google with very good results, maintenance, development and supervision of portals.',
            '',
            '',
            'Stanisław Woźnica, +48 42 / 673 57 05, +48 42 / 602 290 306',
            'http://www.stawoz.pl/'
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'November 2001 - August 2002',
            'Junior PHP developer',
            'Arges.pl',
            '',
            'PHP programmer, software developer. Creation of CMS for several companies. PHP, MySQL and JS tasks.',
            '',
            '',
            '',
            ''
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'October 2001 - November 2001',
            'IT Specialist',
            'Gospodarstwo Pomocnicze Łodzianka',
            '',
            'Implementation of accounting software "Kadry - Płace", "Płatnik - przekaz elektroniczny"',
            '',
            '',
            '',
            ''
            );
        
        return $this->tcpdf;
    }
}
