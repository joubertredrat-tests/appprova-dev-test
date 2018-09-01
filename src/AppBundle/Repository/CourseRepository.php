<?php
/**
 * Dev Test
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppBundle\Repository;

use AppProva\Domain\Repository\CourseRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Course Repository
 *
 * @package AppBundle\Repository
 */
class CourseRepository extends EntityRepository implements CourseRepositoryInterface
{

}
