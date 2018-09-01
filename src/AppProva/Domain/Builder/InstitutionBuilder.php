<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Builder;

use AppProva\Domain\Entity\Institution;
use AppProva\Domain\Exception\Institution\InvalidGeneralScoreException;

/**
 * Institution Builder
 *
 * @package AppProva\Domain\Builder
 */
class InstitutionBuilder
{
    /**
     * @var Institution
     */
    private $institution;

    /**
     * Institution Builder constructor
     */
    public function __construct()
    {
        $this->institution = new Institution();
    }

    /**
     * @param string $name
     * @return InstitutionBuilder
     */
    public function addName(string $name): self
    {
        $this
            ->institution
            ->setName($name)
        ;

        return $this;
    }

    /**
     * @param int $generalScore
     * @return InstitutionBuilder
     * @throws InvalidGeneralScoreException
     */
    public function addGeneralScore(int $generalScore): self
    {
        $this
            ->institution
            ->setGeneralScore($generalScore)
        ;

        return $this;
    }

    /**
     * @return Institution
     */
    public function get(): Institution
    {
        return $this->institution;
    }
}
