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
     * @param InstitutionCourseScore $institutionCourseScore
     * @return void
     */
    public function add(InstitutionCourseScore $institutionCourseScore): void;
}
