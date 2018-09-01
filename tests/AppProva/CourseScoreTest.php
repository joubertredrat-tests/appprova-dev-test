<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests\AppProva;

use AppProva\Domain\Entity\Course;
use AppProva\Domain\Entity\Institution;
use AppProva\Domain\Service\CourseService;
use AppProva\Domain\Service\InstitutionCourseScoreService;
use AppProva\Domain\Service\InstitutionService;
use Tests\AppBundleTestCase;

/**
 * CourseScore Test
 *
 * @package Tests\AppProva
 */
class CourseScoreTest extends AppBundleTestCase
{
    /**
     * @var Institution
     */
    protected $institution;

    /**
     * @var Course
     */
    protected $course;

//    /**
//     * test AddInstitutionCourseScore
//     *
//     * @return void
//     * @throws \AppProva\Domain\Exception\Institution\InvalidGeneralScoreException
//     * @throws \Throwable
//     */
//    public function testAddInstitutionCourseScore(): void
//    {
//        $institution = $this->getInstitution();
//        $course = $this->getCourse();
//        $score = 80;
//
//        $service = $this->getService();
//        $institutionCourseScore = $service->scoreAdd($institution, $course, $score);
//
//        self::assertSame($score, $institutionCourseScore->getScore());
//    }
//
//    /**
//     * test DeleteInstitutionCourseScore
//     *
//     * @return void
//     * @throws \AppProva\Domain\Exception\Institution\InvalidGeneralScoreException
//     * @throws \Throwable
//     */
//    public function testDeleteInstitutionCourseScore(): void
//    {
//        $institution = $this->getInstitution();
//        $course = $this->getCourse();
//        $score = 80;
//
//        $service = $this->getService();
//        $institutionCourseScore = $service->scoreAdd($institution, $course, $score);
//        $assert = $service->scoreDelete($institutionCourseScore->getId());
//
//        self::assertTrue($assert);
//    }

    /**
     * @return Institution
     * @throws \AppProva\Domain\Exception\Institution\InvalidGeneralScoreException
     * @throws \Throwable
     */
    public function getInstitution(): Institution
    {
        if ($this->institution instanceof Institution) {
            return $this->institution;
        }


        $repository = $this
            ->getContainer()
            ->get('app.repository.institution')
        ;

        $logger = $this
            ->getContainer()
            ->get('logger')
        ;

        $service = new InstitutionService($repository, $logger);

        $name = "Faculdade A";
        $generalScore = 100;
        $this->institution = $service->institutionAdd($name, $generalScore);

        return $this->institution;
    }

    /**
     * @return Course
     * @throws \Throwable
     */
    public function getCourse(): Course
    {
        if ($this->course instanceof Course) {
            return $this->course;
        }

        $repository = $this
            ->getContainer()
            ->get('app.repository.course')
        ;

        $logger = $this
            ->getContainer()
            ->get('logger')
        ;

        $service = new CourseService($repository, $logger);

        $name = "Sistemas de Informação";
        $this->course = $service->courseAdd($name);

        return $this->course;
    }

    /**
     * @return InstitutionCourseScoreService
     * @throws \Exception
     */
    public function getService(): InstitutionCourseScoreService
    {
        $repository = $this
            ->getContainer()
            ->get('app.repository.institution_course_score')
        ;

        $logger = $this
            ->getContainer()
            ->get('logger')
        ;

        return new InstitutionCourseScoreService($repository, $logger);
    }
}
