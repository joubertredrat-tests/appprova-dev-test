<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Service;

use AppProva\Domain\Builder\ScoreBuilder;
use AppProva\Domain\Entity\Course;
use AppProva\Domain\Entity\Institution;
use AppProva\Domain\Entity\Score;
use AppProva\Domain\Exception\Score\NotFoundException;
use AppProva\Domain\Repository\ScoreRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Score Service
 *
 * @package AppProva\Domain\Service
 */
class ScoreService
{
    /**
     * @var ScoreRepositoryInterface
     */
    private $scoreRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ScoreService constructor
     *
     * @param ScoreRepositoryInterface $scoreRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        ScoreRepositoryInterface $scoreRepository,
        LoggerInterface $logger
    ) {
        $this->scoreRepository = $scoreRepository;
        $this->logger = $logger;
    }

    /**
     * @param Institution $institution
     * @param Course $course
     * @param int $institutionScore
     * @param int $courseGeneralScore
     * @param int $courseStudentAvgScore
     * @return Score
     * @throws \Throwable
     */
    public function scoreAdd(
        Institution $institution,
        Course $course,
        int $institutionScore,
        int $courseGeneralScore,
        int $courseStudentAvgScore
    ): Score {
        try {
            $scoreBuilder = new ScoreBuilder();
            $score = $scoreBuilder
                ->addInstitution($institution)
                ->addCourse($course)
                ->addInstitutionScore($institutionScore)
                ->addCourseGeneralScore($courseGeneralScore)
                ->addCourseStudentAvgScore($courseStudentAvgScore)
                ->get()
            ;

            $this
                ->scoreRepository
                ->add($score)
            ;

            return $score;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on add score, unknown error: %s",
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
                ->scoreRepository
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
     * @return Score
     */
    public function scoreGet(int $id): Score
    {
        try {
            $institutionCourseScore = $this
                ->scoreRepository
                ->get($id)
            ;

            if (!$institutionCourseScore instanceof Score) {
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
