<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\Controller\Manager;

use AppBundle\Controller\NotifyControllerTrait;
use AppProva\Domain\Exception\Course\NotFoundException as CourseNotFoundException;
use AppProva\Domain\Exception\Institution\NotFoundException as InstitutionNotFoundException;
use AppProva\Domain\Exception\Score\NotFoundException as ScoreNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Score Controller
 *
 * @package AppBundle\Controller\Manager
 */
class ScoreController extends Controller
{
    use NotifyControllerTrait;

    /**
     * @param int $institutionId
     * @return Response
     * @throws \Throwable
     */
    public function listAction(int $institutionId): Response
    {
        try {
            $institutionService = $this->get('app.service.institution');
            $institution = $institutionService->institutionGet($institutionId);

            $scoreService = $this->get('app.service.score');
            $data = $scoreService->scoreGetList($institution);

            return $this->render(
                '@App/manager/score/list.html.twig',
                [
                    'institution' => $institution,
                    'scores' => $data,
                ]
            );
        } catch (InstitutionNotFoundException $e) {
            $this->notifyViewErrorOnTop("Instituição informada não existe");

            return $this->redirectToRoute('app_manager_institution_list');
        } catch (\Throwable $e) {
            $this->notifyViewErrorOnTop("Algo de errado não está certo");

            return $this->redirectToRoute('app_manager_index');
        }
    }

    /**
     * @param int $institutionId
     * @param int $scoreId
     * @return RedirectResponse
     */
    public function deleteAction(int $institutionId, int $scoreId): RedirectResponse
    {
        try {
            $scoreService = $this->get('app.service.score');
            $scoreService->scoreDelete($scoreId);

            $this->notifyViewSuccessOnTop("Avaliação removida com sucesso");

            return $this->redirectToRoute('app_manager_score_list', ['institutionId' => $institutionId]);
        } catch (ScoreNotFoundException $e) {
            $this->notifyViewErrorOnTop("Avaliação informada não existe");

            return $this->redirectToRoute('app_manager_score_list', ['institutionId' => $institutionId]);
        } catch (\Throwable $e) {
            $this->notifyViewErrorOnTop("Algo de errado não está certo");

            return $this->redirectToRoute('app_manager_index');
        }
    }

    /**
     * @param int $institutionId
     * @return Response
     */
    public function addFormAction(int $institutionId): Response
    {
        try {
            $institutionService = $this->get('app.service.institution');
            $institution = $institutionService->institutionGet($institutionId);

            $courseService = $this->get('app.service.course');
            $data = $courseService->getList();

            return $this->render(
                '@App/manager/score/form.html.twig',
                [
                    'institution' => $institution,
                    'courses' => $data,
                ]
            );
        } catch (InstitutionNotFoundException $e) {
            $this->notifyViewErrorOnTop("Instituição informada não existe");

            return $this->redirectToRoute('app_manager_institution_list');
        } catch (\Throwable $e) {
            $this->notifyViewErrorOnTop("Algo de errado não está certo");

            return $this->redirectToRoute('app_manager_index');
        }
    }

    /**
     * @param int $institutionId
     * @param Request $request
     * @return RedirectResponse
     */
    public function addPostAction(int $institutionId, Request $request): RedirectResponse
    {
        try {
            $courseId = $request->get('course');
            $courseGeneralScore = $request->get('generalscore');
            $courseStudentAvgScore = $request->get('studentavgscore');

            $institutionService = $this->get('app.service.institution');
            $institution = $institutionService->institutionGet($institutionId);

            $courseService = $this->get('app.service.course');
            $course = $courseService->courseGet($courseId);

            $scoreService = $this->get('app.service.score');
            $scoreService->scoreAdd($institution, $course, $courseGeneralScore, $courseStudentAvgScore);

            $this->notifyViewSuccessOnTop("Avaliação adicionada com sucesso");

            return $this->redirectToRoute('app_manager_score_list', ['institutionId' => $institutionId]);
        } catch (InstitutionNotFoundException $e) {
            $this->notifyViewErrorOnTop("Instituição informada não existe");

            return $this->redirectToRoute('app_manager_institution_list');
        } catch (CourseNotFoundException $e) {
            $this->notifyViewErrorOnTop("Curso informado não existe");

            return $this->redirectToRoute('app_manager_institution_list');
        } catch (\Throwable $e) {
            $this->notifyViewErrorOnTop("Algo de errado não está certo");

            return $this->redirectToRoute('app_manager_index');
        }
    }
}
