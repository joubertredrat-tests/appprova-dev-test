<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\Controller\Manager;

use AppBundle\Controller\NotifyControllerTrait;
use AppProva\Domain\Exception\Course\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Course Controller
 *
 * @package AppBundle\Controller\Manager
 */
class CourseController extends Controller
{
    use NotifyControllerTrait;

    /**
     * @return Response
     */
    public function listAction():  Response
    {
        $service = $this->get('app.service.course');
        $data = $service->getList();

        return $this->render(
            '@App/manager/course/list.html.twig',
            [
                'courses' => $data,
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
            $service = $this->get('app.service.course');
            $service->courseDelete($id);

            $this->notifyViewSuccessOnTop("Curso removido com sucesso");

            return $this->redirectToRoute('app_manager_course_list');
        } catch (NotFoundException $e) {
            $this->notifyViewErrorOnTop("Curso informado não existe");

            return $this->redirectToRoute('app_manager_course_list');
        } catch (\Throwable $e) {
            $this->notifyViewErrorOnTop("Algo de errado não está certo");

            return $this->redirectToRoute('app_manager_course_list');
        }
    }

    /**
     * @return Response
     */
    public function addFormAction(): Response
    {
        return $this->render('@App/manager/course/form.html.twig');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function addPostAction(Request $request): RedirectResponse
    {
        try {
            $name = $request->get('name');

            $service = $this->get('app.service.course');
            $service->courseAdd($name);

            $this->notifyViewSuccessOnTop("Curso adicionado com sucesso");

            return $this->redirectToRoute('app_manager_course_list');
        } catch (\Throwable $e) {
            $this->notifyViewErrorOnTop("Algo de errado não está certo");

            return $this->redirectToRoute('app_manager_course_list');
        }
    }
}
