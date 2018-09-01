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
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(InstitutionCourseScore $institutionCourseScore): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($institutionCourseScore);
        $entityManager->flush();
    }
}
