<?php
/**
 * @package AppBundle\Controller
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DashboardController
 */
class DashboardController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction() : Response
    {
        return $this->render('Dashboard/index.html.twig');
    }
}
