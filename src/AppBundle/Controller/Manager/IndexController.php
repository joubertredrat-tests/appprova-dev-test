<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\Controller\Manager;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Index Controller
 *
 * @package AppBundle\Controller\Manager
 */
class IndexController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function indexAction(): RedirectResponse
    {
        return $this->redirectToRoute('app_manager_institution_list');
    }
}
