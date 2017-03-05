<?php
/**
 * @copyright 2015-2017 Jakub Luczynski
 * @author Jakub Luczynski <jakub.luczynski@gmail.com>
 * @link http://cv.creolink.pl/
 * @version 2.0.1
 */

namespace Application\Controller;

use Application\Controller\BaseController;
use Zend\Http\Response;
use Application\Config\Locale;

class IndexController extends BaseController
{
    /**
     * @return string
     */
    public function indexAction()
    {
        return $this->getCurriculumVitae()
            ->build()
            ->render();
    }

    /**
     * Home page - auto redirect to english site
     *
     * @return Response
     */
    public function homeAction()
    {
        return $this->redirect()->toRoute(
            'subdomain',
            ['locale' => Locale::DEFAULT_ROUTED_LOCALE]
        );
    }
}
