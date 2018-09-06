<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\Controller\Manager;

use AppBundle\Controller\NotifyControllerTrait;
use AppProva\Domain\Exception\Institution\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Institution Controller
 *
 * @package AppBundle\Controller\Manager
 */
class InstitutionController extends Controller
{
    use NotifyControllerTrait;

    /**
     * @return Response
     */
    public function listAction(): Response
    {
        $service = $this->get('app.service.institution');
        $data = $service->getList();

        return $this->render(
            '@App/manager/institution/list.html.twig',
            [
                'institutions' => $data,
            ]
        );
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteAction(int $id): RedirectResponse
    {
        try {
            $service = $this->get('app.service.institution');
            $service->institutionDelete($id);

            $this->notifyViewSuccessOnTop("Instituição removida com sucesso");

            return $this->redirectToRoute('app_manager_institution_list');
        } catch (NotFoundException $e) {
            $this->notifyViewErrorOnTop("Instituição informada não existe");

            return $this->redirectToRoute('app_manager_institution_list');
        } catch (\Throwable $e) {
            $this->notifyViewErrorOnTop("Algo de errado não está certo");

            return $this->redirectToRoute('app_manager_institution_list');
        }
    }
}
