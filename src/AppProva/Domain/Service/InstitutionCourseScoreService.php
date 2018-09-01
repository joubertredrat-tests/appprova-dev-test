<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Service;

use AppProva\Domain\Builder\InstitutionCourseScoreBuilder;
use AppProva\Domain\Entity\Course;
use AppProva\Domain\Entity\Institution;
use AppProva\Domain\Entity\InstitutionCourseScore;
use AppProva\Domain\Repository\InstitutionCourseScoreRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * InstitutionCourseScore Service
 *
 * @package AppProva\Domain\Service
 */
class InstitutionCourseScoreService
{
    /**
     * @var InstitutionCourseScoreRepositoryInterface
     */
    private $institutionCourseScoreRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * InstitutionCourseScoreService constructor
     *
     * @param InstitutionCourseScoreRepositoryInterface $institutionCourseScoreRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        InstitutionCourseScoreRepositoryInterface $institutionCourseScoreRepository,
        LoggerInterface $logger
    ) {
        $this->institutionCourseScoreRepository = $institutionCourseScoreRepository;
        $this->logger = $logger;
    }

    /**
     * @param Institution $institution
     * @param Course $course
     * @param int $score
     * @return InstitutionCourseScore
     * @throws \Throwable
     */
    public function addScore(
        Institution $institution,
        Course $course,
        int $score
    ): InstitutionCourseScore {
        try {
            $institutionCourseScoreBuilder = new InstitutionCourseScoreBuilder();
            $institutionCourseScore = $institutionCourseScoreBuilder
                ->addInstitution($institution)
                ->addCourse($course)
                ->addScore($score)
                ->get()
            ;

            $this
                ->institutionCourseScoreRepository
                ->add($institutionCourseScore)
            ;

            return $institutionCourseScore;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on add course score for institution, unknown error: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;

            throw $e;
        }
    }
}
