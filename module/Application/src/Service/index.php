<?php
// errors
ini_set('error_reporting', E_ALL); // ^ E_NOTICE ^ E_DEPRECATED
ini_set('display_errors', true);

// locale data
setlocale(LC_ALL, 'de_DE.utf8'); // 'pl_PL.utf8', 'de_DE.utf8', 'en_GB.utf8'

// timezone
ini_set('date.timezone', 'Europe/Warsaw');
if (function_exists('date_default_timezone_set')) { date_default_timezone_set('Europe/Warsaw'); }

// encoding
mb_internal_encoding('UTF-8');

// other
ini_set('magic_quotes_gpc', 'off');
ini_set('allow_call_time_pass_reference', 'off');

require_once(realpath('TCPDF/tcpdf.php'));
require_once(realpath('DateHelper.php'));

class CurriculumVitae extends TCPDF
{
    public $isDownloaded = false;
    public $selectedLanguage = 'en';

    private $verdana = '';
    private $verdanaItalic = '';
    private $tahoma = '';
    private $tahomaBold = '';
    private $tahomaItalic = '';
    private $dejavu = '';
    private $cursorPositionX = 0;
    private $cursorPositionY = 0;
    private $workStartYear = 2001;
    private $documentAuthor = 'Jakub Luczynski';
    private $documentTitle = 'Jakub Luczynski, Curriculum Vitae';
    private $documentKeywords = 'Jakub Luczynski, CV, web developer, php, specialist, project manager';
    private $birthDate = '01/19/1979';
    
    private $nationality = 'Polish';
    private $country = 'Germany';
    private $street = 'Am Wall 54';
    private $city = 'Kleinmachnow';
    private $postCode = '14532';
    private $phone = '+49 1521 7786892';
    private $phoneUrl = 'tel:04915217786892';
    private $email = 'jakub.luczynski@gmail.com';
    private $emailUrl = 'mailto:jakub.luczynski@gmail.com';
    private $cvUrl = 'http://cv.creolink.pl';
    
    public function render()
    {
        $this->configure();
        
        $this->addNewPage();

        $this->renderMainHeader();
        $this->technicalSkills();
        $this->renderPersonalSkills();
        $this->knownTools();
        $this->careerGoals();
        $this->renderLanguages();
        $this->renderEmploymentHistory();
        $this->renderEducation();
        $this->renderHobby();
        $this->renderAboutMe();
        
        $this->addNewPage();
        $this->renderCommisionedJobs();
        $this->renderQRCode();
        $this->renderSign();
        
        /*
        $this->_references('gandalf_references_en_1'); // references
        $this->_references('gandalf_references_en_2'); // references
        $this->_references('tpnets_en_1'); // references
        $this->_references('tpnets_en_2'); // references
        $this->_references('freepers_en'); // references
        $this->_references('forweb_en_1'); // references
        $this->_references('forweb_en_2'); // references
        $this->_references('forweb_en_3'); // references
        $this->_references('stawoz_en_1'); // references
        $this->_references('stawoz_en_2'); // references
        $this->_references('iizt'); // references
        //*/
        
        $this->Output();
    }
    
	public function footer()
    {
        $text = "I hereby give consent for my personal data included in my offer to be processed for the purposes of recruitment, in accordance with the\r\nPersonal Data Protection Act dated 29.08.1997 (uniform text: Journal of Laws of the Republic of Poland 2002 No 101, item 926 with further amendments).";
        
        $this->SetXY(5, -15);
        $this->SetFont($this->verdana, '', 6);
        $this->SetTextColor(150, 150, 150);
        $this->MultiCell(200, 3, $text, 0, 'C', FALSE);
        $this->Cell(223, 4, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'R');
	}
    
    public function header()
    {
        if ($this->getPage() > 1) {
            $this->SetTextColor(150, 150, 150);
            $this->SetDrawColor(150, 150, 150);
            
            $x = 62;
            $y = 6;
            $width = 5.5;
            $height = 7;

            $this->Image('images/photo.png', $x, $y - 1.5, $width, $height, 'PNG', $this->cvUrl);
            $this->Rect($x, $y - 1.5, $width, $height);
            
            $this->SetY($y);
            $this->SetFont($this->verdana, '', 6);
            $this->Cell(223, 4, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'R');
            
            $this->SetXY($x + 7, $y);
            $this->Write(4, $this->documentTitle);
            
            $x = $this->GetX();
            $this->renderIcon($x + 2, $y, 'images/phone.png', $this->phone, $this->phoneUrl, 1);
            $this->renderIcon($x + 30, $y, 'images/email.png', $this->email, $this->emailUrl, 1);
            $this->renderIcon($x + 67, $y, 'images/skype.png', 'luczynski.jakub', 'skype:luczynski.jakub', 1);
        }
    }
    
    private function configure()
    {
        $this->Open();
        $this->SetCreator($this->documentAuthor . ', powered by TCPDF');
        $this->SetAuthor($this->documentAuthor);
        $this->SetTitle($this->documentTitle);
        $this->SetSubject($this->documentTitle);
        $this->SetKeywords($this->documentKeywords);
        $this->SetCompression(true);
        $this->SetDisplayMode('real');
        $this->SetAutoPageBreak(true, 10);
        $this->setFontSubsetting(true);
        $this->setPrintHeader(true);
        $this->setPrintFooter(true);
        
        $this->verdana = TCPDF_FONTS::addTTFfont('fonts/unifont/verdana.ttf', '', '', 32);
        $this->verdanaItalic = TCPDF_FONTS::addTTFfont('fonts/unifont/verdanai.ttf', '', '', 32);
        $this->tahoma = TCPDF_FONTS::addTTFfont('fonts/unifont/tahoma.ttf', '', '', 32);
        $this->tahomaBold = TCPDF_FONTS::addTTFfont('fonts/unifont/tahomabd.ttf', '', '', 32);
        $this->tahomaItalic = TCPDF_FONTS::addTTFfont('fonts/unifont/tahomai.ttf', '', '', 32);
        $this->dejavu = TCPDF_FONTS::addTTFfont('fonts/unifont/DejaVuSansCondensed.ttf', '', '', 32);
    }
    
    private function addNewPage()
    {
        $this->SetMargins(1, 1, 1);
        
        $this->AddPage();
        
        $this->SetTextColor(0, 0, 0);
        $this->SetFont($this->dejavu, '', 8);
        $this->SetXY(0, 0);
    }
    
    private function renderIcon($x, $y, $image, $text, $url, $move = 0)
    {
        $this->SetFont('verdana', '', 6);
        
        $this->Image($image, $x, $y, 4, 4, 'PNG');
        $this->SetXY($x + 4 + $move, $y - 1);
        $this->Cell(10, 6, $text, 0, 0, 'L', false, $url);
    }
    
    private function renderPersonalData()
    {
        $posYText = 4; $posYBox = 5;
        
        $this->SetFont($this->dejavu, '', 8);
        $this->SetFillColor(235,235,235);
        
        $this->RoundedRect(152, $posYBox, 22, 4, 1, '1111', 'DF');
        $this->SetXY(152, $posYText); $this->Cell(10, 6, 'Experience', 0, 0, 'L', false);
        $this->SetXY(174, $posYText); $this->Cell(10, 6, $this->getWorkStartYear() . ' years', 0, 0, 'L', false);
        
        $dateHelper = new DateHelper(strtotime($this->birthDate));
        $this->RoundedRect(152, $posYBox+=5, 22, 4, 1, '1111', 'DF');
        $this->SetXY(152, $posYText+=5); $this->Cell(10, 6, 'Date of birth', 0, 0, 'L', false);
        $this->SetXY(174, $posYText); $this->Cell(10, 6, $dateHelper->getDate(), 0, 0, 'L', false); //'19 January 1979'
        
        $this->RoundedRect(152, $posYBox+=5, 22, 4, 1, '1111', 'DF');
        $this->SetXY(152, $posYText+=5); $this->Cell(10, 6, 'Nationality', 0, 0, 'L', false);
        $this->SetXY(174, $posYText); $this->Cell(10, 6, $this->nationality, 0, 0, 'L', false);
        
        $this->RoundedRect(152, $posYBox+=5, 22, 4, 1, '1111', 'DF');
        $this->SetXY(152, $posYText+=5); $this->Cell(10, 6, 'Location', 0, 0, 'L', false);
        $this->SetXY(174, $posYText); $this->Cell(10, 6, $this->country, 0, 0, 'L', false);
        
        $this->RoundedRect(152, $posYBox+=5, 22, 4, 1, '1111', 'DF');
        $this->SetXY(152, $posYText+=5); $this->Cell(10, 6, 'Address', 0, 0, 'L', false);
        $this->SetXY(174, $posYText+=1); $this->MultiCell(35, 5, $this->street . "\n" . $this->postCode . ' ' . $this->city , 0, 'L', false);
        
        $this->RoundedRect(152, $posYBox+=8, 22, 4, 1, '1111', 'DF');
        $this->SetXY(152, $posYText+=7); $this->Cell(10, 6, 'Workplace', 0, 0, 'L', false);
        $this->SetXY(174, $posYText); $this->Cell(10, 6, 'Berlin Area, Potsdam', 0, 0, 'L', false);
    }
    
    private function renderPersonalDataPhoto()
    {
        $x = 19;
        $y = 5;
        $width = 30;
        $height = 37;

        $this->Image('images/photo.png', $x, $y, $width, $height, 'PNG', $this->emailUrl);
        
        $this->SetDrawColor(150, 150, 150);
        $this->Rect($x, $y, $width, $height);
        
        $this->SetXY(20.7, 40);
        
        $this->SetTextColor(150, 150, 150);
        $this->SetFont($this->tahoma, 'B', 5.5);
        $this->Write(6, 'most recent on cv.creolink.pl', $this->cvUrl);
    }
    
    private function renderMainHeader()
    {
        $this->SetXY(0, 0);

        $this->SetLineWidth(0.1);
        
        $this->SetFillColor(245,246,244);
        $this->Rect(0, 0, 210, 45, 'F');
        
        $this->SetTextColor(76, 76, 76);
        $this->SetFont($this->tahomaBold, '', 30); $this->Text(85, 5, 'JAKUB');
        $this->SetFont($this->tahomaBold, '', 30); $this->Text(72, 16, 'ŁUCZYŃSKI');
        
        $this->SetTextColor(138, 138, 138);
        $this->SetFont($this->tahoma, '', 8); $this->Text(66, 29, 'WEB DEVELOPER, PHP SPECIALIST & PROJECT MANAGER');
        
        $this->SetTextColor(180, 180, 180); $this->SetXY(113, 31);
        $this->SetFont($this->tahoma, 'B', 5.5); $this->Write(6, 'CV created with PHP & TCPDF', 'https://tcpdf.org/');
        
        $this->SetDrawColor(200, 200, 200);
        
        $this->Rect(11, 6, 5, 3);
        $this->Image('images/en.png', 11, 6, 5, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?en');
        
        $this->Rect(11, 10, 5, 3);
        $this->Image('images/de.png', 11, 10, 5, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?en');
        
        $this->Rect(11, 14, 5, 3);
        $this->Image('images/pl.png', 11, 14, 5, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?pl');
        
        if (!$this->isDownloaded) { $this->Image('images/save.png', 12, 18, 3, 3, 'PNG', 'http://'.$_SERVER['SERVER_NAME'].'/?download&en'); }

        $this->Line(0, 39, 210, 39);
        $this->Line(0, 45, 210, 45);
        
        $this->renderPersonalDataPhoto();
        
        $this->SetTextColor(50, 50, 50);
        $this->renderIcon(55, 40, 'images/phone.png', $this->phone, $this->phoneUrl);
        $this->renderIcon(83, 40, 'images/email.png', $this->email, $this->emailUrl);
        $this->renderIcon(120, 40, 'images/linkedin.png', '/jakubluczynski', 'http://pl.linkedin.com/in/jakubluczynski');
        $this->renderIcon(143, 40, 'images/skype.png', 'luczynski.jakub', 'skype:luczynski.jakub');
        $this->renderIcon(167, 40, 'images/goldenline.png', '/jakub-luczynski', 'http://www.goldenline.pl/jakub-luczynski/');
        
        $this->renderPersonalData();
    }
    
    private function getWorkStartYear()
    {
        return date("Y") - $this->workStartYear;
    }
    
    private function careerGoals()
    {
        $x = 5;
        $y = 47;
        
        $this->renderBlockTitle('Career goals', $x, $y, 200, 27.5);
        
        $this->SetFont($this->verdanaItalic, 'I', 9);
        $this->SetXY($x + 1, $y + 7);
        $this->Cell(100, 6, 'Dear Sir or Madam / Mr Smith / Ms Smith / Mrs Smith', 0, 0, 'L', false);
        
        $this->SetFont($this->verdanaItalic, 'I', 7.5);
        $this->SetXY($x + 1, $y + 12);
        $this->MultiCell(198, 4, "I am a full stack developer. My passion is system designing and coding in PHP language. I have many years of experience as programmer in project design & development (" . $this->getWorkStartYear() . " years) as well as team coordinator and project manager (6 years). I feel the best as developer and coder of big B2E, B2B, B2C eCommerce web projects. I like all kind of tasks, easy and challenging one. I gladly accept challenges basing on new technical solutions. I'm very well organized, thorough and flexible in teamwork. I am also appreciated for independent and remote work. My future goal is to become a manager of big IT department of international company.\r\n", 0, 'J', false);
    }
    
    private function technicalSkills()
    {
        $x = 5;
        $y = 77;
        
        $this->renderBlockTitle('Technical skills', $x, $y, 65, 67.5);

        $x = $this->cursorPositionX + 2;
        $y = $this->cursorPositionY;
        $step = 3.5;
        $textWidth = 38;
        
        $this->renderSkillOnLeft($x, $y, 'PHP 4/5/6/7, OOP & PSR', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'MySQL & MariaDB / Percona', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'TDD, UnitTesting', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Symfony 2 & 3', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'SOLID, Clear code, KISS, DRY', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Soap, Rest, Json, Xml, OAuth', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'SEO, SEM', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'UML, WEB / UI / DB Design', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Patterns: Factory, DI, MVC, ...', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'X/HTML5, Css, Sass, Less', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'JS, jQuery, React, Typescript', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Nginx config, Lighttpd, Apache', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Elastic Search, Solr, Sphinx', 3, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'MsSQL, PostgreSQL', 2, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'ZF 1/2, Smarty', 2, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Perl, Python, C#, Java, C++', 1, $textWidth);
    }
    
    private function knownTools()
    {
        $x = 72.5;
        $y = 77;
        
        $this->renderBlockTitle('Known software & tools', $x, $y, 65);
        
        $x = $this->cursorPositionX + 2;
        $y = $this->cursorPositionY;
        $step = 3.5;
        $textWidth = 38;
        
        $this->renderSkillOnLeft($x, $y, 'Netbeans, PHPStorm', 6, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Linux: Debian, Ubuntu, Fedora', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'SVN, GIT, JIRA, Trac, Jenkins', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Composer, Node.js, npm', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'FPDF, TCPDF, Adobe PDF', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'PHP FPM, APC, Memcache', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Percona server, Galera Cluster', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'CodeSniffer, PhpDoc', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'mytop, mysqltuner', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'MySQL Workbench', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'HTML Validator, W3C', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Mrtg, Cacti, Mtr, Traceroute', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'DIA, Software Ideas Modeler', 4, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Apache jMeter', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Google Analytics, Adwords', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'GIMP, Photoshop', 3, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'VirtualBox, Docker, Vagrant', 3, $textWidth);
        
        // Commented for future needs
        //$this->renderSkillOnLeft($x, $y += $step, 'xenu, Total validator', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'adminer', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Adwords', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'manual UI tests, acceptance tests', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Audio Watermarking Tools 2', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Macromedia Fireworks, Macromedia Dreamweaver', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Firefox, Opera, Chrome, IE', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Cluster Control (Percona, SeveralNines)', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'MS Office, LibreOffice, OpenOffice', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Eset', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Total Commander, mc', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Acunetix web vulnerability scanner', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Axure RP Pro', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Bootstrap', 3, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Grunt', 3, $textWidth);
        //$this->skillOnLeft($x, $y += $step, 'Enova, Optima, WFMag, Subiekt', 5, $textWidth);
    }
    
    private function renderPersonalSkills()
    {
        $x = 140;
        $y = 77;

        $this->renderBlockTitle('Personality', $x, $y, 65);
        
        $x = $this->cursorPositionX + 2;
        $y = $this->cursorPositionY;
        $step = 4;
        $textWidth = 38;
        
        $this->renderSkillOnLeft($x, $y, 'Organization', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Reliability', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Teamwork', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Punctuality', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Management & Team leading', 4, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Precision', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Assertiveness', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Independence', 4, $textWidth);
        //$this->renderSkillOnLeft($x, $y += $step, 'Obstinacy', 5, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Diligence', 4, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Work under time pressure', 3, $textWidth);
        $this->renderSkillOnLeft($x, $y += $step, 'Creativity', 3, $textWidth);
    }
    
    private function renderLanguages()
    {
        $x = 140;
        $y = 123.5;
        
        $this->renderBlockTitle('Languages', $x, $y, 65);
        
        $x = $this->cursorPositionX + 2;
        $y = $this->cursorPositionY;
        $step = 3.5;
        $textWidth = 38;
        
        $this->renderSkillOnLeft($x, $y, 'Polish, mother language', 5);
        $this->renderSkillOnLeft($x, $y += $step, 'English (C1), prof. proficiency', 4);
        $this->renderSkillOnLeft($x, $y += $step, 'German (B1), communicative', 2);
    }
    
    private function renderEmploymentHistory()
    {
        $x = 5;
        $y = 145;
        
        $this->renderBlockTitle('Employment history, full & part time', $x, $y, 200, 27.5);

        $this->renderEmploymentPosition(
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
    }
    
    private function renderCommisionedJobs()
    {
        $x = 5;
        $y = 14;
        
        $this->renderBlockTitle('Additional, commisioned & freelance jobs', $x, $y, 200, 27.5);
        
        $step = 4;
        
        $x = $this->cursorPositionX;
        $y = $this->cursorPositionY;
        
        $this->renderEmploymentPosition(
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
            $this->cursorPositionX,
            $this->cursorPositionY,
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
    }
    
    private function renderEmploymentPosition(
        $x,
        $y,
        $date = '',
        $positionName = '',
        $company = '',
        $address = '',
        $description = '',
        $examples = '',
        $references = '',
        $contact = '',
        $companyUrl = ''
    ) {
        $width = 197;
        
        $this->SetXY($x, $y);
        
        $this->SetTextColor(90, 90, 90);
        
        $this->SetFont($this->tahoma, '', 8);
        $this->Cell(50, 6, $date . ', ' . $company, 0, 0, 'L', false);
        
        $this->SetXY($x, $y += 4.5);
        $this->SetFont($this->tahomaBold, '', 9);
        $this->Cell(150, 6, $positionName, 0, 0, 'L', false);
        
        $this->SetTextColor(100, 100, 15);
        $this->SetFont($this->tahoma, '', 7);
        
        if (false === empty($references)) {
            $this->SetXY($x, $y + 1.5);
            $this->Cell(195, 2.2, 'References', '', 0, 'R', false, $references);
            $this->Image('images/save.png', $this->GetX(), $y + 1.5, 2.5, 2.5, 'PNG', $references);
        }

        if (false === empty($examples)) {
            $shift = (false === empty($references) ? 17 : 0);
            $this->SetXY($x, $y + 1.5);
            $this->Cell(195 - $shift, 2.2, 'Examples', '', 0, 'R', false, $examples);
            $this->Image('images/save.png', $this->GetX(), $y + 1.5, 2.5, 2.5, 'PNG', $examples);
        }
        
        $this->SetTextColor(90, 90, 90);
        $this->SetXY($x + 1.5, $y += 5.5);
        $this->SetFont($this->tahoma, '', 8);
        $this->MultiCell($width, 4, $description . "\r\n", 0, 'J', false);
        
        $this->SetTextColor(138, 138, 138);
        
        $y = $this->GetY() + 0.6;
        
        $urlWidth = 0;
        if (false === empty($companyUrl)) {
            $this->SetXY($x + 1, $y - 0.1);
            $this->SetFont($this->tahoma, '', 6.5);
            $this->Cell($width, 2, $companyUrl, 0, 0, 'R', false, $companyUrl);
            $urlWidth = (int)$this->GetStringWidth($companyUrl) + 0.3;
        }

        if (false === empty($contact)) {
            $this->SetXY($x + 1, $y - 0.1);
            $this->SetFont($this->tahoma, '', 6.5);
            $text = 'Contact: '
                .$contact
                .', '
                .$address
                .($urlWidth > 0 ? ', ' : '');
            
            $this->Cell($width - $urlWidth, 2, $text, 0, 0, 'R', false);
        }
        
//        $this->SetTextColor(100, 100, 15);
//        $this->SetFont($this->tahoma, '', 7);
//        
//        if (false === empty($references)) {
//            $this->SetXY($x + 4, $y);
//            $this->Cell(10, 2.2, 'References', '', 0, 'C', false, $references);
//            $this->Image('images/save.png', $this->GetX() + 1.5, $y, 2.5, 2.5, 'PNG', $references);
//        }
//
//        if (false === empty($examples)) {
//            $shift = (false == empty($references) ? 20 : 0);
//            $this->SetXY($x + $shift, $y);
//            $this->Cell(10, 2.2, 'Examples', '', 0, 'C', false, $examples);
//            $this->Image('images/save.png', $this->GetX() + 1, $y, 2.5, 2.5, 'PNG', $examples);
//        }
        
        $this->cursorPositionY = $this->getY() + 4.3;
    }
    
    private function renderQRCode()
    {
        $style = array(
            'border' => false,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false,
            'module_width' => 1,
            'module_height' => 1
        );

        $text = 'BEGIN:VCARD'. "\n"
            . 'VERSION:2.1' . "\n"
            . 'FN:' . $this->documentAuthor . "\n"
            . 'TITLE:PHP Developer' . "\n"
            . 'TEL:' . $this->phone . "\n"
            . 'EMAIL:' . $this->email . "\n"
            . 'PHOTO;PNG:http://cv.creolink.pl/i/photo.png' . "\n"
            . 'ADR:;;' . $this->street . ';' . $this->city . ';;' . $this->postCode . ';' . $this->country . "\n"
            . 'URL:' . $this->cvUrl . "\n"
            . 'END:VCARD';

        $this->write2DBarcode($text, 'QRCODE,L', 155, 220, 50, 50, $style, 'N');
    }
    
    private function renderEducation()
    {
        $x = 5;
        $y = 249;
        
        $this->renderBlockTitle('Education & courses', $x, $y, 65);

        $text = '2013 - 2015 intensive English & German course, 2012 professional Google Analytics training, since 2012 driving license category B, further past: studies at the Lodz University of Technology (computer science, 3 years)';
        
        $this->SetXY($this->cursorPositionX, $this->cursorPositionY + 1);
        $this->SetFont($this->tahoma, '', 7);
        $this->MultiCell(63, 4, $text . "\r\n", 0, 'L', false);
    }
    
    private function renderHobby()
    {
        $x = 72.5;
        $y = 249;
        
        $this->renderBlockTitle('Hobby & Sport', $x, $y, 65);
        
        $text = 'movies and series, board games, computer games, football, horse riding, table tennis, stock exchange, money saving';
        
        $this->SetXY($this->cursorPositionX, $this->cursorPositionY + 1);
        $this->SetFont($this->tahoma, '', 7);
        $this->MultiCell(63, 4, $text . "\r\n", 0, 'L', false);
    }
    
    private function renderAboutMe()
    {
        $x = 140;
        $y = 249;
        
        $this->renderBlockTitle('About me in a nutshell', $x, $y, 65);
        
        $text = "I am married and we have " . (date("Y") - 2005) . " years old son. "
            ."In 2015 we've started new life in Germany. "
            ."I do not smoke since " . (date("Y") - 2006) . " years. "
            ."In 2016, through regular diet and systematic training I have lost 35 kg. "
            ."I've developed my own PHP framework and I've used it in all my commissioned projects. "
            ."I've got references from almost all companies I worked for. "
            ."This CV is an example of my abilities.";
        
        $this->SetXY($this->cursorPositionX, $this->cursorPositionY + 1);
        $this->SetFont($this->tahoma, '', 7);
        $this->MultiCell(63, 4, $text . "\r\n", 0, 'L', false);
    }
    
    private function renderSign()
    {
        $this->SetDrawColor(200, 200, 200);
        $this->SetLineWidth(0.1);
        $this->Line(35, 255, 150, 255);
        
        $text = 'Should you find my knowledge and professional experience interesting and it could help in progress of your company, please contact with me by phone, by mail or by Skype.';
        
        $this->SetXY(35, 248);
        $this->SetTextColor(50, 50, 50);
        $this->SetFont($this->verdanaItalic, 'I', 7);
        $this->MultiCell(120, 4, $text . "\r\n", 0, 'L', false);
        
        $this->Image('images/sign.png', 50, 250, 90, 25, 'PNG');
    }
    
    private function renderBlockTitle($title, $x = 5, $y = 50, $width = 65, $hasLine = false, $height = 65)
    {
        $this->SetDrawColor(150, 150, 150);
        $this->SetFillColor(245,246,244);
        $this->SetTextColor(90, 90, 90);

        $this->SetFont($this->dejavu, 'B', 13);
        $this->SetXY($x + 0.6, $y);
        $this->Cell(100, 6, $title, 0, 0, 'L', false);
        
        $this->SetLineStyle(
                array('width' => 0.2, 'dash' => '0')
            );
        $this->Line($x, $y + 6, $x + $width, $y + 6);
        
        if (true === $hasLine) {
            $this->SetLineStyle(
                    array('width' => 0.2, 'dash' => '3,3')
                );
            $this->Line($x + 2, $y + 8, $x + 2, $y + $height);
        }
        
        $this->cursorPositionX = $x + 1;
        $this->cursorPositionY = $this->GetY() + 6;
    }
    
    private function renderSkillOnRight($x, $y, $text = '', $value = 5, $textWidth = 33)
    {
        $this->SetFont($this->verdana, '', 7);
        
        $this->SetXY($x, $y);
        $this->Cell(53, 6, $text, 0, 0, 'L', false);
        
        $lineStyle = array(
            'width' => 0.1,
            'dash' => '0'
        );
        
        $fillColor = array(100, 100, 100);
        
        $y = $y + 3;
        $x = $x + $textWidth;
        
        for ($counter = 0; $counter < 6; $counter++) {
            $this->renderCircle($x + (3.5 * $counter), $y);
            if ($value > $counter) {
                $this->renderCircle($x + (3.5 * $counter), $y, true);
            }
        }
    }
    
    private function renderSkillOnLeft($x, $y, $text = '', $value = 5, $textWidth = 53)
    {
        $this->SetFont($this->verdana, '', 8);
        
        $this->SetXY($x + 15.8, $y);
        $this->Cell($textWidth, 6, $text, 0, 0, 'L', false);
        
        $lineStyle = array(
            'width' => 0.1,
            'dash' => '0'
        );
        
        $fillColor = array(100, 100, 100);
        
        $y = $y + 3.2;
        
        for ($counter = 0; $counter < 5; $counter++) {
            $this->renderCircle($x + (3.5 * $counter), $y);
            if ($value > $counter) {
                $this->renderCircle($x + (3.5 * $counter), $y, true);
            }
        }
    }
    
    private function renderCircle($x, $y, $filled = false)
    {
        $radius = 1.3;
        $style = '';
        $lineStyle = array(
            'width' => 0.1,
            'dash' => '0',
            'color' => array(
                150, 150, 150
            )
        );
        $fillColor = array();
        
        if (true === $filled) {
            $radius = 0.9;
            $fillColor = array(100, 100, 100);
            $style = 'F';
        }
        
        $this->circle($x, $y, $radius, 0, 360, $style, $lineStyle, $fillColor);
    }
}

$pdf = new CurriculumVitae('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->render();




