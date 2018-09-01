<?php
/**
 * Dev Test
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Repository;

use AppProva\Domain\Entity\Course;

/**
 * Course Repository Interface
 *
 * @package AppProva\Domain\Repository
 */
interface CourseRepositoryInterface
{
    /**
     * @param Course $course
     * @return void
     */
    public function add(Course $course): void;
}
