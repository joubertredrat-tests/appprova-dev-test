<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests\AppProva;

use AppProva\Domain\Service\CourseService;
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
        $nameNew = "Ciência da Computação";

        $service = $this->getService();
        $courseCreated = $service->courseAdd($nameOld);
        $courseUpdated = $service->courseUpdate($courseCreated->getId(), $nameNew);

        self::assertEquals($nameNew, $courseUpdated->getName());
        self::assertNotEquals($nameOld, $courseUpdated->getName());
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
