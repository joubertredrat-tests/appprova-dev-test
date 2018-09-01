<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Builder;

use AppProva\Domain\Entity\Course;
use AppProva\Domain\Entity\Institution;
use AppProva\Domain\Entity\Score;

/**
 * Score Builder
 *
 * @package AppProva\Domain\Builder
 */
class ScoreBuilder
{
    /**
     * @var Score
     */
    private $score;

    /**
     * ScoreBuilder constructor
     */
    public function __construct()
    {
        $this->score = new Score();
    }

    /**
     * @param Institution $institution
     * @return ScoreBuilder
     */
    public function addInstitution(Institution $institution): self
    {
        $this
            ->score
            ->setInstitution($institution)
        ;

        return $this;
    }

    /**
     * @param Course $course
     * @return ScoreBuilder
     */
    public function addCourse(Course $course): self
    {
        $this
            ->score
            ->setCourse($course)
        ;

        return $this;
    }

    /**
     * @param int $institutionScore
     * @return ScoreBuilder
     * @throws \AppProva\Domain\Exception\Score\InvalidScoreException
     */
    public function addInstitutionScore(int $institutionScore): self
    {
        $this
            ->score
            ->setInstitutionScore($institutionScore)
        ;

        return $this;
    }

    /**
     * @param int $courseGeneralScore
     * @return ScoreBuilder
     * @throws \AppProva\Domain\Exception\Score\InvalidScoreException
     */
    public function addCourseGeneralScore(int $courseGeneralScore): self
    {
        $this
            ->score
            ->setCourseGeneralScore($courseGeneralScore)
        ;

        return $this;
    }

    /**
     * @param int $courseStudentAvgScore
     * @return ScoreBuilder
     * @throws \AppProva\Domain\Exception\Score\InvalidScoreException
     */
    public function addCourseStudentAvgScore(int $courseStudentAvgScore): self
    {
        $this
            ->score
            ->setCourseStudentAvgScore($courseStudentAvgScore)
        ;

        return $this;
    }

    /**
     * @return Score
     */
    public function get(): Score
    {
        return $this->score;
    }
}
