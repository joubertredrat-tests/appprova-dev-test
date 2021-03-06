<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Exception\Score;

/**
 * NotFound Exception
 *
 * @package AppProva\Domain\Exception\Score
 */
class NotFoundException extends \Exception
{
    /**
     * @param int $id
     * @return NotFoundException
     */
    public static function onDatabase(int $id): self
    {
        return new self(
            sprintf("Course score for institution not found on database: %d", $id)
        );
    }
}
