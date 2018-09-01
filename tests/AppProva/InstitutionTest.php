<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests\AppProva;

use AppProva\Domain\Exception\Institution\InvalidGeneralScoreException;
use AppProva\Domain\Service\InstitutionService;
use Tests\AppBundleTestCase;

/**
 * Institution Test
 *
 * @package Tests\AppProva
 */
class InstitutionTest extends AppBundleTestCase
{
    /**
     * test InstitutionCreate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testInstitutionCreate(): void
    {
        $name = "Faculdade A";
        $generalScore = 100;

        $service = $this->getService();
        $institution = $service->institutionAdd($name, $generalScore);

        self::assertEquals($name, $institution->getName());
        self::assertEquals($generalScore, $institution->getGeneralScore());
    }

    /**
     * test ExceptionOnWrongGeneralScore
     *
     * @return void
     * @throws InvalidGeneralScoreException
     * @throws \Throwable
     */
    public function testExceptionOnWrongGeneralScore(): void
    {
        self::expectException(InvalidGeneralScoreException::class);

        $name = "Faculdade A";
        $generalScore = 101;

        $service = $this->getService();
        $service->institutionAdd($name, $generalScore);
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
