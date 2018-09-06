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
     * @return array<Score>
     */
    public function scoreGetList(Institution $institution): array
    {
        return $this
            ->scoreRepository
            ->getList($institution)
        ;
    }

    /**
     * @param Institution $institution
     * @param Course $course
     * @param int $courseGeneralScore
     * @param int $courseStudentAvgScore
     * @return Score
     * @throws \Throwable
     */
    public function scoreAdd(
        Institution $institution,
        Course $course,
        int $courseGeneralScore,
        int $courseStudentAvgScore
    ): Score {
        try {
            $scoreBuilder = new ScoreBuilder();
            $score = $scoreBuilder
                ->addInstitution($institution)
                ->addCourse($course)
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
                "Fail on add score: %s",
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
     * @throws \Throwable
     */
    public function scoreDelete(int $id): bool
    {
        try {
            $score = $this->scoreGet($id);

            $this
                ->scoreRepository
                ->delete($score)
            ;

            return true;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on delete course score for institution: %s",
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
     * @return Score
     * @throws \Throwable
     */
    public function scoreGet(int $id): Score
    {
        try {
            $score = $this
                ->scoreRepository
                ->get($id)
            ;

            if (!$score instanceof Score) {
                throw NotFoundException::onDatabase($id);
            }

            return $score;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on get course score for institution: %s",
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
