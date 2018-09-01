<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Builder;

use AppProva\Domain\Entity\Course;

/**
 * Course Builder
 *
 * @package AppProva\Domain\Builder
 */
class CourseBuilder
{
    /**
     * @var Course
     */
    private $course;

    /**
     * CourseBuilder constructor
     */
    public function __construct()
    {
        $this->course = new Course();
    }

    /**
     * @param string $name
     * @return CourseBuilder
     */
    public function addName(string $name): self
    {
        $this
            ->course
            ->setName($name)
        ;

        return $this;
    }

    /**
     * @return Course
     */
    public function get(): Course
    {
        return $this->course;
    }
}
