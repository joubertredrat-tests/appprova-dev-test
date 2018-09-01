<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Repository;

use AppProva\Domain\Entity\Score;

/**
 * Score Repository Interface
 *
 * @package AppProva\Domain\Repository
 */
interface ScoreRepositoryInterface
{
    /**
     * @param int $id
     * @return Score|null
     */
    public function get(int $id): ?Score;

    /**
     * @param Score $score
     * @return void
     */
    public function add(Score $score): void;

    /**
     * @param Score $score
     * @return void
     */
    public function delete(Score $score): void;
}
