<?php
/**
 * Dev Test
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Service;

use AppProva\Domain\Builder\InstitutionBuilder;
use AppProva\Domain\Entity\Institution;
use AppProva\Domain\Exception\Institution\InvalidGeneralScoreException;
use AppProva\Domain\Exception\Institution\NotFoundException;
use AppProva\Domain\Repository\InstitutionRepositoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Institution Service
 *
 * @package AppProva\Domain\Service
 */
class InstitutionService
{
    /**
     * @var InstitutionRepositoryInterface
     */
    private $institutionRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Institution Service constructor
     *
     * @param InstitutionRepositoryInterface $institutionRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        InstitutionRepositoryInterface $institutionRepository,
        LoggerInterface $logger
    ) {
        $this->institutionRepository = $institutionRepository;
        $this->logger = $logger;
    }

    /**
     * @param string $name
     * @param int $generalScore
     * @return Institution
     * @throws InvalidGeneralScoreException
     * @throws \Throwable
     */
    public function institutionAdd(string $name, int $generalScore): Institution
    {
        try {
            $institutionBuilder = new InstitutionBuilder();
            $institution = $institutionBuilder
                ->addName($name)
                ->addGeneralScore($generalScore)
                ->get()
            ;

            $this
                ->institutionRepository
                ->add($institution)
            ;

            return $institution;
        } catch (InvalidGeneralScoreException $e) {
            $message = sprintf(
                "Fail on create institution, invalid general score: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;

            throw $e;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on create institution, unknown error: %s",
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
     * @param string $name
     * @param int $generalScore
     * @return Institution
     * @throws NotFoundException
     * @throws \Throwable
     */
    public function institutionUpdate(int $id, string $name, int $generalScore): Institution
    {
        try {
            $institution = $this->institutionGet($id);
            $institution->setName($name);
            $institution->setGeneralScore($generalScore);

            $this
                ->institutionRepository
                ->update($institution)
            ;

            return $institution;
        } catch (NotFoundException $e) {
            $message = sprintf(
                "Fail on update institution, invalid general score: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;

            throw $e;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on update institution, unknown error: %s",
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
     * @return Institution
     * @throws NotFoundException
     * @throws \Throwable
     */
    public function institutionGet(int $id): Institution
    {
        try {
            $institution = $this
                ->institutionRepository
                ->get($id)
            ;

            if (!$institution instanceof Institution) {
                throw NotFoundException::onDatabase($id);
            }

            return $institution;
        } catch (NotFoundException $e) {
            $message = sprintf(
                "Fail on get institution, invalid general score: %s",
                $e->getMessage()
            );

            $this
                ->logger
                ->error($message)
            ;

            throw $e;
        } catch (\Throwable $e) {
            $message = sprintf(
                "Fail on get institution, unknown error: %s",
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
