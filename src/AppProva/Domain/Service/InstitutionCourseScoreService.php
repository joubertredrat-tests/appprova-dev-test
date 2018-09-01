<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Service;

use AppProva\Domain\Builder\InstitutionCourseScoreBuilder;
use AppProva\Domain\Entity\Course;
use AppProva\Domain\Entity\Institution;
use AppProva\Domain\Entity\InstitutionCourseScore;
use AppProva\Domain\Exception\InstitutionCourseScore\NotFoundException;
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
    public function scoreAdd(
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

    /**
     * @param int $id
     * @return bool
     */
    public function scoreDelete(int $id): bool
    {
        try {
            $institutionCourseScore = $this->scoreGet($id);

            $this
                ->institutionCourseScoreRepository
                ->delete($institutionCourseScore)
            ;

            return true;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on delete course score for institution, unknown error: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;
        }
    }

    /**
     * @param int $id
     * @return InstitutionCourseScore
     */
    public function scoreGet(int $id): InstitutionCourseScore
    {
        try {
            $institutionCourseScore = $this
                ->institutionCourseScoreRepository
                ->get($id)
            ;

            if (!$institutionCourseScore instanceof InstitutionCourseScore) {
                throw NotFoundException::onDatabase($id);
            }

            return $institutionCourseScore;
        } catch (NotFoundException $e) {
            $message = sprintf(
                "Fail on get course score for institution: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on get course score for institution, unknown error: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;
        }
    }
}
