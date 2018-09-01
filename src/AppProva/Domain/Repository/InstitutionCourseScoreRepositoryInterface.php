<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Repository;

use AppProva\Domain\Entity\InstitutionCourseScore;

/**
 * InstitutionCourseScore Repository Interface
 *
 * @package AppProva\Domain\Repository
 */
interface InstitutionCourseScoreRepositoryInterface
{
    /**
     * @param int $id
     * @return InstitutionCourseScore|null
     */
    public function get(int $id): ?InstitutionCourseScore;

    /**
     * @param InstitutionCourseScore $institutionCourseScore
     * @return void
     */
    public function add(InstitutionCourseScore $institutionCourseScore): void;

    /**
     * @param InstitutionCourseScore $institutionCourseScore
     * @return void
     */
    public function delete(InstitutionCourseScore $institutionCourseScore): void;
}
