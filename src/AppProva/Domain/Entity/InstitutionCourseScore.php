<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Entity;

use AppProva\Domain\Exception\InstitutionCourseScore\InvalidScoreException;
use RedRat\Entity\DateTimeTrait;

/**
 * Institution CourseScore
 *
 * @package AppProva\Domain\Entity
 */
class InstitutionCourseScore
{
    use DateTimeTrait;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $score;

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
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     * @return void
     * @throws InvalidScoreException
     */
    public function setScore(int $score): void
    {
        if ($score < 0) {
            throw InvalidScoreException::lessThanZero($score);
        }

        if ($score > 100) {
            throw InvalidScoreException::moreThanOneHundred($score);
        }

        $this->score = $score;
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
