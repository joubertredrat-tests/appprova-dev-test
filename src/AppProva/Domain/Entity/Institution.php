<?php
/**
 * Dev Test
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Entity;

use AppProva\Domain\Exception\Institution\InvalidGeneralScoreException;
use Doctrine\Common\Collections\ArrayCollection;
use RedRat\Entity\DateTimeTrait;

/**
 * Institution
 *
 * @package AppProva\Domain\Entity
 */
class Institution
{
    use DateTimeTrait;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $generalScore;

    /**
     * @var ArrayCollection
     */
    private $coursesScore;

    /**
     * Institution constructor
     */
    public function __construct()
    {
        $this->coursesScore = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getGeneralScore(): int
    {
        return $this->generalScore;
    }

    /**
     * @param int $generalScore
     * @return void
     * @throws InvalidGeneralScoreException
     */
    public function setGeneralScore(int $generalScore): void
    {
        if ($generalScore < 0) {
            throw InvalidGeneralScoreException::lessThanZero($generalScore);
        }

        if ($generalScore > 100) {
            throw InvalidGeneralScoreException::moreThanOneHundred($generalScore);
        }

        $this->generalScore = $generalScore;
    }

    /**
     * @param InstitutionCourseScore $courseScore
     * @return bool
     */
    public function hasCourseScore(InstitutionCourseScore $courseScore): bool
    {
        return $this
            ->coursesScore
            ->contains($courseScore)
        ;
    }

    /**
     * @param InstitutionCourseScore $courseScore
     * @return void
     */
    public function addCourseScore(InstitutionCourseScore $courseScore): void
    {
        if ($this->hasCourseScore($courseScore)) {
            return;
        }

        $this
            ->coursesScore
            ->add($courseScore)
        ;
    }

    /**
     * @param InstitutionCourseScore $courseScore
     * @return void
     */
    public function removeCourseScore(InstitutionCourseScore $courseScore): void
    {
        $this
            ->coursesScore
            ->removeElement($courseScore)
        ;
    }

    /**
     * @return array<InstitutionCourseScore>
     */
    public function getCourseScore(): array
    {
        return $this
            ->coursesScore
            ->toArray()
        ;
    }
}
