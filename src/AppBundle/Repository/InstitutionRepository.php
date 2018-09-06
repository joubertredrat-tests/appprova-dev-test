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
     */
    public function getListBy(?string $institutionName = null): array
    {
        $queryBuilder = $this->createQueryBuilder('i');

        $queryBuilder
            ->join('i.score', 's')
            ->join('s.course', 'c')
        ;

        if ($institutionName) {
            $queryBuilder
                ->andWhere(
                    $queryBuilder
                        ->expr()
                        ->like('i.name', ':institutionName')
                )
                ->setParameter('institutionName', '%' . $institutionName . '%')
            ;
        }

        $queryBuilder->orderBy('i.generalScore', 'desc');

        $result = $queryBuilder
            ->getQuery()
            ->getResult()
        ;

        return $result;
    }

    /**
     * @param int $id
     * @return Institution|null
     */
    public function get(int $id): ?Institution
    {
        /** @var Institution $institution */
        $institution = $this->find($id);

        return $institution;
    }

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

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     */
    public function update(Institution $institution): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($institution);
        $entityManager->flush($institution);
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(Institution $institution): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($institution);
        $entityManager->flush($institution);
    }
}
