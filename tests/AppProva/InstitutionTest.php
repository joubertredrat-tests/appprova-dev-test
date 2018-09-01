<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests\AppProva;

use AppProva\Domain\Exception\Institution\InvalidGeneralScoreException;
use AppProva\Domain\Exception\Institution\NotFoundException;
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
     * test InstitutionUpdate
     *
     * @throws InvalidGeneralScoreException
     * @throws \Throwable
     */
    public function testInstitutionUpdate(): void
    {
        $nameOld = "Faculdade A";
        $generalScoreOld = 100;
        $nameNew = "Faculdade B";
        $generalScoreNew = 10;

        $service = $this->getService();
        $institutionCreated = $service->institutionAdd($nameOld, $generalScoreOld);

        $institutionUpdated = $service
            ->institutionUpdate(
                $institutionCreated->getId(),
                $nameNew,
                $generalScoreNew
            )
        ;

        self::assertEquals($nameNew, $institutionUpdated->getName());
        self::assertEquals($generalScoreNew, $institutionUpdated->getGeneralScore());
        self::assertNotEquals($nameOld, $institutionUpdated->getName());
        self::assertNotEquals($generalScoreOld, $institutionUpdated->getGeneralScore());
    }

    /**
     * test ExceptionOnUpdateInstitutionNotFoundOnDatabase
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testExceptionOnUpdateInstitutionNotFoundOnDatabase(): void
    {
        self::expectException(NotFoundException::class);

        $service = $this->getService();

        $service
            ->institutionUpdate(
                99999999999,
                "Faculdade B",
                10
            )
        ;
    }

    /**
     * test InstitutionDelete
     *
     * @return void
     * @throws InvalidGeneralScoreException
     * @throws \Throwable
     */
    public function testInstitutionDelete(): void
    {
        $name = "Faculdade A";
        $generalScore = 100;

        $service = $this->getService();
        $institution = $service->institutionAdd($name, $generalScore);
        $assert = $service->institutionDelete($institution->getId());

        self::assertTrue($assert);
    }

    /**
     * test ExceptionOnDeleteInstitutionNotFoundOnDatabase
     *
     * @throws NotFoundException
     * @throws \Throwable
     */
    public function testExceptionOnDeleteInstitutionNotFoundOnDatabase(): void
    {
        self::expectException(NotFoundException::class);

        $service = $this->getService();
        $service->institutionDelete(99999999999);
    }

    /**
     * test InstitutionGet
     *
     * @return void
     * @throws InvalidGeneralScoreException
     * @throws \Throwable
     */
    public function testInstitutionGet(): void
    {
        $name = "Faculdade A";
        $generalScore = 100;

        $service = $this->getService();
        $institution = $service->institutionAdd($name, $generalScore);
        $institutionFound = $service->institutionGet($institution->getId());

        self::assertEquals($name, $institutionFound->getName());
        self::assertEquals($generalScore, $institutionFound->getGeneralScore());
    }

    /**
     * test ExceptionOnGetInstitutionNotFoundOnDatabase
     *
     * @return void
     * @throws NotFoundException
     * @throws \Throwable
     */
    public function testExceptionOnGetInstitutionNotFoundOnDatabase(): void
    {
        self::expectException(NotFoundException::class);

        $service = $this->getService();
        $service->institutionGet(99999999999);
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
