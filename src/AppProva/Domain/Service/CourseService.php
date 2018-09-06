<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Service;

use AppProva\Domain\Builder\CourseBuilder;
use AppProva\Domain\Entity\Course;
use AppProva\Domain\Exception\Course\NotFoundException;
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
     * @return array<Course>
     */
    public function getList(): array
    {
        return $this
            ->courseRepository
            ->getList()
        ;
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

    /**
     * @param int $id
     * @param string $name
     * @return Course
     * @throws NotFoundException
     * @throws \Throwable
     */
    public function courseUpdate(int $id, string $name): Course
    {
        try {
            $course = $this->courseGet($id);
            $course->setName($name);

            $this
                ->courseRepository
                ->update($course)
            ;

            return $course;
        } catch (NotFoundException $e) {
            $message = sprintf(
                "Fail on update course: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;

            throw $e;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on update course, unknown error: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;

            throw $e;
        }
    }

    /**
     * @param int $id
     * @return bool
     * @throws NotFoundException
     * @throws \Throwable
     */
    public function courseDelete(int $id): bool
    {
        try {
            $institution = $this->courseGet($id);

            $this
                ->courseRepository
                ->delete($institution)
            ;

            return true;
        } catch (NotFoundException $e) {
            $message = sprintf(
                "Fail on delete course: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;

            throw $e;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on delete course, unknown error: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;

            throw $e;
        }
    }

    /**
     * @param int $id
     * @return Course
     * @throws NotFoundException
     * @throws \Throwable
     */
    public function courseGet(int $id): Course
    {
        try {
            $course = $this
                ->courseRepository
                ->get($id);

            if (!$course instanceof Course) {
                throw NotFoundException::onDatabase($id);
            }

            return $course;
        } catch (NotFoundException $e) {
            $message = sprintf(
                "Fail on get course: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;

            throw $e;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on get course, unknown error: %s",
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
