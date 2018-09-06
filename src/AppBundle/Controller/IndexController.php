<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Index Controller
 *
 * @package AppBundle\Controller
 */
class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function listAction(Request $request): Response
    {
        $institutionName = $request->get('institution-name', null);
        $courseName = $request->get('course-name', null);
        $institutionGeneralScore = $request->get('institution-generalscore', null);
        $courseGeneralScore = $request->get('course-generalscore', null);
        $courseStudentAvgScore = $request->get('course-studentavgscore', null);

        if (empty($institutionName)) {
            $institutionName = null;
        }

        if (empty($courseName)) {
            $courseName = null;
        }

        if (empty($institutionGeneralScore)) {
            $institutionGeneralScore = null;
        }

        if (empty($courseGeneralScore)) {
            $courseGeneralScore = null;
        }

        if (empty($courseStudentAvgScore)) {
            $courseStudentAvgScore = null;
        }

        $service = $this->get('app.service.institution');
        $data = $service->getListBy(
            $institutionName,
            $courseName,
            $institutionGeneralScore,
            $courseGeneralScore,
            $courseStudentAvgScore
        );

        return $this->render(
            '@App/list.html.twig',
            [
                'institutions' => $data,
            ]
        );
    }
}
