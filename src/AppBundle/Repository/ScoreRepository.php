<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\Repository;

use AppProva\Domain\Entity\Score;
use AppProva\Domain\Repository\ScoreRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Score Repository
 *
 * @package AppBundle\Repository
 */
class ScoreRepository extends EntityRepository implements ScoreRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function get(int $id): ?Score
    {
        /** @var Score $score */
        $score = $this->find($id);

        return $score;
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Score $score): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($score);
        $entityManager->flush();
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(Score $score): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($score);
        $entityManager->flush($score);
    }
}
