<?php
/**
 * Dev Test
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Repository;

use AppProva\Domain\Entity\Institution;

/**
 * Institution Repository Interface
 *
 * @package AppProva\Domain\Repository
 */
interface InstitutionRepositoryInterface
{
    /**
     * @param int $id
     * @return Institution|null
     */
    public function get(int $id): ?Institution;

    /**
     * @param Institution $institution
     * @return void
     */
    public function add(Institution $institution): void;

    /**
     * @param Institution $institution
     * @return void
     */
    public function update(Institution $institution): void;

    /**
     * @param Institution $institution
     * @return void
     */
    public function delete(Institution $institution): void;
}
