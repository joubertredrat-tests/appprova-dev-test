<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests\AppProva;

use AppProva\Domain\Entity\Course;
use AppProva\Domain\Exception\Course\NotFoundException;
use AppProva\Domain\Service\CourseService;
use PHPUnit\Framework\Constraint\IsType;
use Tests\AppBundleTestCase;

/**
 * Course Test
 *
 * @package Tests\AppProva
 */
class CourseTest extends AppBundleTestCase
{
    /**
     * test CourseCreate
     *
     * @return void
     * @throws \Throwable
     */
    public function testCourseCreate(): void
    {
        $name = "Sistemas de Informação";

        $service = $this->getService();
        $course = $service->courseAdd($name);

        self::assertEquals($name, $course->getName());
    }

    /**
     * test CourseUpdate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testCourseUpdate(): void
    {
        $nameOld = "Sistemas de Informação";
        $nameNew = "Ciências Contábeis";

        $service = $this->getService();
        $courseCreated = $service->courseAdd($nameOld);
        $courseUpdated = $service->courseUpdate($courseCreated->getId(), $nameNew);

        self::assertEquals($nameNew, $courseUpdated->getName());
        self::assertNotEquals($nameOld, $courseUpdated->getName());
    }

    /**
     * test ExceptionOnUpdateCourseNotFoundOnDatabase
     *
     * @return void
     * @throws NotFoundException
     * @throws \Throwable
     */
    public function testExceptionOnUpdateCourseNotFoundOnDatabase(): void
    {
        self::expectException(NotFoundException::class);

        $service = $this->getService();

        $service
            ->courseUpdate(
                99999999999,
                "Ciências Contábeis"
            )
        ;
    }

    /**
     * test CourseDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testCourseDelete(): void
    {
        $name = "Sistemas de Informação";

        $service = $this->getService();
        $course = $service->courseAdd($name);
        $assert = $service->courseDelete($course->getId());

        self::assertTrue($assert);
    }

    /**
     * test ExceptionOnDeleteCourseNotFoundOnDatabase
     *
     * @return void
     * @throws NotFoundException
     * @throws \Throwable
     */
    public function testExceptionOnDeleteCourseNotFoundOnDatabase(): void
    {
        self::expectException(NotFoundException::class);

        $service = $this->getService();
        $service->courseDelete(99999999999);
    }

    /**
     * test CourseList
     *
     * @return void
     */
    public function testCourseList(): void
    {
        self::assertInternalType(IsType::TYPE_ARRAY, null);
        self::assertInstanceOf(Course::class, null);
    }

    /**
     * @return CourseService
     * @throws \Exception
     */
    public function getService(): CourseService
    {
        $repository = $this
            ->getContainer()
            ->get('app.repository.course')
        ;

        $logger = $this
            ->getContainer()
            ->get('logger')
        ;

        return new CourseService($repository, $logger);
    }
}
