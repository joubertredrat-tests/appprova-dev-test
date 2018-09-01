<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Builder;

use AppProva\Domain\Entity\Course;
use AppProva\Domain\Entity\Institution;
use AppProva\Domain\Entity\InstitutionCourseScore;

/**
 * InstitutionCourseScore Builder
 *
 * @package AppProva\Domain\Builder
 */
class InstitutionCourseScoreBuilder
{
    /**
     * @var InstitutionCourseScore
     */
    private $institutionCourseScore;

    /**
     * InstitutionCourseScoreBuilder constructor
     */
    public function __construct()
    {
        $this->institutionCourseScore = new InstitutionCourseScore();
    }

    /**
     * @param Institution $institution
     * @return InstitutionCourseScoreBuilder
     */
    public function addInstitution(Institution $institution): self
    {
        $this
            ->institutionCourseScore
            ->setInstitution($institution)
        ;

        return $this;
    }

    /**
     * @param Course $course
     * @return InstitutionCourseScoreBuilder
     */
    public function addCourse(Course $course): self
    {
        $this
            ->institutionCourseScore
            ->setCourse($course)
        ;

        return $this;
    }

    /**
     * @param int $score
     * @return InstitutionCourseScoreBuilder
     * @throws \AppProva\Domain\Exception\InstitutionCourseScore\InvalidScoreException
     */
    public function addScore(int $score): self
    {
        $this
            ->institutionCourseScore
            ->setScore($score)
        ;

        return $this;
    }

    /**
     * @return InstitutionCourseScore
     */
    public function get(): InstitutionCourseScore
    {
        return $this->institutionCourseScore;
    }
}
