<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests\AppProva;

use AppProva\Domain\Entity\Course;
use AppProva\Domain\Entity\Institution;
use AppProva\Domain\Exception\Score\NotFoundException;
use AppProva\Domain\Service\CourseService;
use AppProva\Domain\Service\InstitutionService;
use AppProva\Domain\Service\ScoreService;
use Tests\AppBundleTestCase;

/**
 * Score Test
 *
 * @package Tests\AppProva
 */
class ScoreTest extends AppBundleTestCase
{
    /**
     * @var Institution
     */
    protected $institution;

    /**
     * @var Course
     */
    protected $course;

    /**
     * test AddScore
     *
     * @return void
     * @throws \Throwable
     */
    public function testAddScore(): void
    {
        $institution = $this->getInstitution();
        $course = $this->getCourse();
        $institutionScore = 100;
        $courseGeneralScore = 100;
        $courseStudentAvgScore = 100;

        $service = $this->getService();
        $score = $service->scoreAdd(
            $institution,
            $course,
            $institutionScore,
            $courseGeneralScore,
            $courseStudentAvgScore
        );

        self::assertSame($institutionScore, $score->getInstitutionScore());
        self::assertSame($courseGeneralScore, $score->getCourseGeneralScore());
        self::assertSame($courseStudentAvgScore, $score->getCourseStudentAvgScore());
    }

    /**
     * test DeleteScore
     *
     * @return void
     * @throws \Throwable
     */
    public function testDeleteScore(): void
    {
        $institution = $this->getInstitution();
        $course = $this->getCourse();
        $institutionScore = 100;
        $courseGeneralScore = 100;
        $courseStudentAvgScore = 100;

        $service = $this->getService();
        $score = $service->scoreAdd(
            $institution,
            $course,
            $institutionScore,
            $courseGeneralScore,
            $courseStudentAvgScore
        );

        $assert = $service->scoreDelete($score->getId());

        self::assertTrue($assert);
    }

    /**
     * test ExceptionOnDeleteNotFoundOnDatabase
     *
     * @return void
     * @throws \Throwable
     */
    public function testExceptionOnDeleteNotFoundOnDatabase(): void
    {
        self::expectException(NotFoundException::class);

        $service = $this->getService();
        $service->scoreDelete(99999999999);
    }

    /**
     * @return Institution
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
     * @return ScoreService
     * @throws \Exception
     */
    public function getService(): ScoreService
    {
        $repository = $this
            ->getContainer()
            ->get('app.repository.score')
        ;

        $logger = $this
            ->getContainer()
            ->get('logger')
        ;

        return new ScoreService($repository, $logger);
    }
}
