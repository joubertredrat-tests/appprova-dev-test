<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\Repository;

use AppProva\Domain\Entity\InstitutionCourseScore;
use AppProva\Domain\Repository\InstitutionCourseScoreRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * InstitutionCourseScore Repository
 *
 * @package AppBundle\Repository
 */
class InstitutionCourseScoreRepository extends EntityRepository implements InstitutionCourseScoreRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function get(int $id): ?InstitutionCourseScore
    {
        /** @var InstitutionCourseScore $institutionCourseScore */
        $institutionCourseScore = $this->find($id);

        return $institutionCourseScore;
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(InstitutionCourseScore $institutionCourseScore): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($institutionCourseScore);
        $entityManager->flush();
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(InstitutionCourseScore $institutionCourseScore): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($institutionCourseScore);
        $entityManager->flush($institutionCourseScore);
    }
}
