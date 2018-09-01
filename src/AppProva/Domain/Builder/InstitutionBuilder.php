<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Builder;

use AppProva\Domain\Entity\Institution;

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
     * @return Institution
     */
    public function get(): Institution
    {
        return $this->institution;
    }
}
