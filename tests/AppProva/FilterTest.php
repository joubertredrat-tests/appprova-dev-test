<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests\AppProva;

use AppProva\Domain\Service\InstitutionService;
use Tests\AppBundleTestCase;

/**
 * Filter Test
 *
 * @package Tests\AppProva
 */
class FilterTest extends AppBundleTestCase
{
    /**
     * test FilterByInstitutionName
     *
     * @return void
     * @throws \Exception
     */
    public function testFilterByInstitutionName(): void
    {
        $filter = "Universidade";
        $results = 2;

        $service = $this->getService();
        $data = $service->getListBy($filter);

        self::assertEquals($results, count($data));
        self::assertContains($filter, $data[0]->getName());
        self::assertContains($filter, $data[1]->getName());
        self::assertThat(
            $data[0]->getGeneralScore(),
            $this->logicalAnd(
                $this->greaterThanOrEqual(
                    $data[1]->getGeneralScore()
                )
            )
        );
    }

    /**
     * test FilterByCourseName
     *
     * @return void
     * @throws \Exception
     */
    public function testFilterByCourseName(): void
    {
        $filter = "Informação";
        $results = 3;

        $service = $this->getService();
        $data = $service->getListBy(null, $filter);

        self::assertEquals($results, count($data));
        self::assertContains(
            $filter,
            $data[0]->getScore()[0]->getCourse()->getName()
        );
        self::assertContains(
            $filter,
            $data[1]->getScore()[0]->getCourse()->getName()
        );
        self::assertContains(
            $filter,
            $data[2]->getScore()[0]->getCourse()->getName()
        );
    }

    /**
     * test FilterByInstitutionGeneralScore
     *
     * @return void
     * @throws \Exception
     */
    public function testFilterByInstitutionGeneralScore(): void
    {
        $filter = 90;
        $results = 1;

        $service = $this->getService();
        $data = $service->getListBy(null, null, $filter);

        self::assertEquals($results, count($data));
        self::assertEquals($filter, $data[0]->getGeneralScore());
    }

    /**
     * test FilterByCourseGeneralScore
     *
     * @return void
     * @throws \Exception
     */
    public function testFilterByCourseGeneralScore(): void
    {
        $filter = 79;
        $results = 1;

        $service = $this->getService();
        $data = $service->getListBy(null, null, null, $filter);

        self::assertEquals($results, count($data));
        self::assertEquals($filter, $data[0]->getScore()[2]->getCourseGeneralScore());
    }

    /**
     * test FilterByCourseStudentAvgScore
     *
     * @return void
     */
    public function testFilterByCourseStudentAvgScore(): void
    {
        $filter = 70;
        $results = 1;

        $data = [];

        self::assertEquals($results, count($data));
        self::assertEquals($filter, 0);
    }

    /**
     * @return InstitutionService
     * @throws \Exception
     */
    public function getService(): InstitutionService
    {
        $repository = $this
            ->getContainer()
            ->get('app.repository.institution')
        ;

        $logger = $this
            ->getContainer()
            ->get('logger')
        ;

        return new InstitutionService($repository, $logger);
    }
}
