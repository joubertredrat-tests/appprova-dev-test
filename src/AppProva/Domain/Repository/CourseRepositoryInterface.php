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
     * @param int $id
     * @return Course|null
     */
    public function get(int $id): ?Course;

    /**
     * @param Course $course
     * @return void
     */
    public function add(Course $course): void;

    /**
     * @param Course $course
     * @return void
     */
    public function update(Course $course): void;

    /**
     * @param Course $course
     * @return void
     */
    public function delete(Course $course): void;
}
