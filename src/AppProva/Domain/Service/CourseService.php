<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Service;

use AppProva\Domain\Builder\CourseBuilder;
use AppProva\Domain\Entity\Course;
use AppProva\Domain\Repository\CourseRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Course Service
 *
 * @package AppProva\Domain\Service
 */
class CourseService
{
    /**
     * @var CourseRepositoryInterface
     */
    private $courseRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * CourseService constructor
     *
     * @param CourseRepositoryInterface $courseRepository
     * @param LoggerInterface $logger
     */
    public function __construct(CourseRepositoryInterface $courseRepository, LoggerInterface $logger)
    {
        $this->courseRepository = $courseRepository;
        $this->logger = $logger;
    }

    /**
     * @param string $name
     * @return Course
     * @throws \Throwable
     */
    public function courseAdd(string $name): Course
    {
        try {
            $courseBuilder = new CourseBuilder();
            $course = $courseBuilder
                ->addName($name)
                ->get()
            ;

            $this
                ->courseRepository
                ->add($course)
            ;

            return $course;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on create course, unknown error: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;

            throw $e;
        }
    }
}
