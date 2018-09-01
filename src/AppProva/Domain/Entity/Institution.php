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
     * @var ArrayCollection
     */
    private $score;

    /**
     * Institution constructor
     */
    public function __construct()
    {
        $this->score = new ArrayCollection();
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
     * @param Score $score
     * @return bool
     */
    public function hasScore(Score $score): bool
    {
        return $this
            ->score
            ->contains($score)
        ;
    }

    /**
     * @param Score $score
     * @return void
     */
    public function addCourseScore(Score $score): void
    {
        if ($this->hasScore($score)) {
            return;
        }

        $this
            ->score
            ->add($score)
        ;
    }

    /**
     * @param Score $score
     * @return void
     */
    public function removeScore(Score $score): void
    {
        $this
            ->score
            ->removeElement($score)
        ;
    }

    /**
     * @return array<Score>
     */
    public function getScore(): array
    {
        return $this
            ->score
            ->toArray()
        ;
    }
}
