<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Entity;

use AppProva\Domain\Exception\Score\InvalidScoreException;
use RedRat\Entity\DateTimeTrait;

/**
 * Score
 *
 * @package AppProva\Domain\Entity
 */
class Score
{
    use DateTimeTrait;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $institutionScore;

    /**
     * @var int
     */
    private $courseGeneralScore;

    /**
     * @var int
     */
    private $courseStudentAvgScore;

    /**
     * @var Institution
     */
    private $institution;

    /**
     * @var Course
     */
    private $course;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getInstitutionScore(): int
    {
        return $this->institutionScore;
    }

    /**
     * @param int $institutionScore
     * @return void
     * @throws InvalidScoreException
     */
    public function setInstitutionScore(int $institutionScore): void
    {
        if ($institutionScore < 0) {
            throw InvalidScoreException::lessThanZero($institutionScore);
        }

        if ($institutionScore > 100) {
            throw InvalidScoreException::moreThanOneHundred($institutionScore);
        }

        $this->institutionScore = $institutionScore;
    }

    /**
     * @return int
     */
    public function getCourseGeneralScore(): int
    {
        return $this->courseGeneralScore;
    }

    /**
     * @param int $courseGeneralScore
     * @return void
     * @throws InvalidScoreException
     */
    public function setCourseGeneralScore(int $courseGeneralScore): void
    {
        if ($courseGeneralScore < 0) {
            throw InvalidScoreException::lessThanZero($courseGeneralScore);
        }

        if ($courseGeneralScore > 100) {
            throw InvalidScoreException::moreThanOneHundred($courseGeneralScore);
        }

        $this->courseGeneralScore = $courseGeneralScore;
    }

    /**
     * @return int
     */
    public function getCourseStudentAvgScore(): int
    {
        return $this->courseStudentAvgScore;
    }

    /**
     * @param int $courseStudentAvgScore
     * @return void
     * @throws InvalidScoreException
     */
    public function setCourseStudentAvgScore(int $courseStudentAvgScore): void
    {
        if ($courseStudentAvgScore < 0) {
            throw InvalidScoreException::lessThanZero($courseStudentAvgScore);
        }

        if ($courseStudentAvgScore > 100) {
            throw InvalidScoreException::moreThanOneHundred($courseStudentAvgScore);
        }

        $this->courseStudentAvgScore = $courseStudentAvgScore;
    }

    /**
     * @return Institution
     */
    public function getInstitution(): Institution
    {
        return $this->institution;
    }

    /**
     * @param Institution $institution
     * @return void
     */
    public function setInstitution(Institution $institution): void
    {
        $this->institution = $institution;
    }

    /**
     * @return Course
     */
    public function getCourse(): Course
    {
        return $this->course;
    }

    /**
     * @param Course $course
     * @return void
     */
    public function setCourse(Course $course): void
    {
        $this->course = $course;
    }
}
