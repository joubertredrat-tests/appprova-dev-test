<?php
/**
 * Dev Test
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Entity;

use AppProva\Domain\Exception\Institution\InvalidGeneralScoreException;
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
}
