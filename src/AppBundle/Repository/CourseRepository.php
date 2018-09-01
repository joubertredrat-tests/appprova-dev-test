<?php
/**
 * Dev Test
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\Repository;

use AppProva\Domain\Entity\Course;
use AppProva\Domain\Repository\CourseRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Course Repository
 *
 * @package AppBundle\Repository
 */
class CourseRepository extends EntityRepository implements CourseRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function get(int $id): ?Course
    {
        /** @var Course $course */
        $course = $this->find($id);

        return $course;
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Course $course): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($course);
        $entityManager->flush();
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     */
    public function update(Course $course): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($course);
        $entityManager->flush($course);
    }
}
