<?php
/**
 * Dev Test
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\Repository;

use AppProva\Domain\Entity\Institution;
use AppProva\Domain\Repository\InstitutionRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Institution Repository
 *
 * @package AppBundle\Repository
 */
class InstitutionRepository extends EntityRepository implements InstitutionRepositoryInterface
{
    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Institution $institution): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($institution);
        $entityManager->flush();
    }
}
