<?php
/**
 * Dev Test
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use RedRat\Entity\DateTimeTrait;

/**
 * Course
 *
 * @package AppProva\Domain\Entity
 */
class Course
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
     * @var ArrayCollection
     */
    private $institutionsScore;

    /**
     * Course constructor.
     */
    public function __construct()
    {
        $this->institutionsScore = new ArrayCollection();
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
     * @return array<InstitutionCourseScore>
     */
    public function getInstitutionScore(): array
    {
        return $this
            ->institutionsScore
            ->toArray()
        ;
    }
}
