<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 */

namespace Application\Element;

use Application\Element\AbstractEmployment;

class EmploymentHistory extends AbstractEmployment
{
    /**
     * {@inheritDoc}
     */
    public function addElements()
    {
        parent::addElements();
        
        return $this->renderEmploymentHistory();
    }
    
    private function renderEmploymentHistory()
    {
        $x = 5;
        $y = 143;
        
        $this->renderBlockTitle('Employment history, full & part time', $x, $y, 200, 27.5);

        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'October 2015 - ...present',
            'Software Engineer / B2B project',
            'AUTO1 Group GmbH',
            'Bergmannstraße 72, 10961 Berlin, Germany',
            'Responsibility for development of new, company flagship product. Building applications with Elastic Search, Symfony 2 / 3, Web services, Json, Node.js, React.js, Typescript and Silex. Implementation of unit tests. Code reviews and refactoring. Creating technical & project documentation using Confluence.',
            '',
            '',
            '+49 30 / 201 63 405 ',
            'http://www.auto1.com'
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'May 2009 - August 2015',
            'IT Manager / B2E & B2C, eCommerce complex solution',
            'GANDALF SP. Z O.O. (Empik Media & Fashion Group)',
            'Beskidzka 37, 91-612, Lodz, Poland',
            'Supervision of complex eCommerce & Intranet system. Organisation of work and tasks scheduling through SVN & Trac. Implementation of new technical solutions like Solr, PHP-FPM, APC, Nginx, VMware ESX. Employees management, budget controlling, reporting, API integration, business processes optimization, SEO & SEM analysis, performance & acceptance tests, code refactoring, software tests, duties of the Information Security Administrator.',
            'http://cv.creolink.pl/examples/gandalf.zip',
            'http://cv.creolink.pl/references/references_gandalf.zip',
            'Anetta Wilczynska, +48 42 / 252 39 23',
            'http://www.gandalf.com.pl'
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'September 2002 - May 2009',
            'Project manager and lead PHP coder / B2E, B2B & B2C system for ISP',
            'FORWEB S.C.',
            'Lagiewnicka 54/56, 91-463, Lodz, Poland',
            "Design, development & implementation of dedicated, proprietary B2E, B2B & B2C system for ISP (demo at http://mms.4web.pl/, http://demo.4web.pl/). Coordination of tasks of IT Section. Reporting and documentation. Communication and meetings with customers. Analysis, tests and system integrations. Optimization and refactoring, coding with MySQL, MSSQL, PostgreSQL, PHP, Perl, Python. Supervision and maintenance of existing applications.",
            'http://cv.creolink.pl/examples/forweb.zip',
            'http://cv.creolink.pl/references/references_forweb.zip',
            'Tomasz Pawlowski, (+48 42) 235 1000',
            'http://www.forweb.pl'
            );
        
        $this->renderEmploymentPosition(
            $this->tcpdf->cursorPositionX,
            $this->tcpdf->cursorPositionY,
            'July 2005 - June 2008 (part time)',
            'PHP lead developer, IT Specialist / B2E & B2C eCommerce project',
            'Ksiegarnia Internetowa Gandalf (Online Bookstore "Gandalf")',
            'Al. Pilsudskiego 135, 92-318, Lodz, Poland',
            'Maintenance, development and modernization of dedicated, proprietary CRM & CMS eCommerce system based on my own MVC framework. Coding, optimization and refactoring, analysis. Implementation of new technical solutions based on PHP, Lighttpd, MySQL. Integration with external API using SOAP, Rest, XML, CSV. UI & Web design. Analysis and optimisation of SEO & SEM processes. Technical supervision.',
            '',
            '',
            'Anetta Wilczynska, +48 42 / 252 39 23',
            'http://www.gandalf.com.pl'
            );
        
        return $this->tcpdf;
    }
}
