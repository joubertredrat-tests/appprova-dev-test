<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Exception\Score;

/**
 * InvalidScore Exception
 *
 * @package AppProva\Domain\Exception\Score
 */
class InvalidScoreException extends \Exception
{
    /**
     * @param int $score
     * @return InvalidScoreException
     */
    public static function lessThanZero(int $score): self
    {
        return new self(
            sprintf("Score less than 0: %d", $score)
        );
    }

    /**
     * @param int $score
     * @return InvalidScoreException
     */
    public static function moreThanOneHundred(int $score): self
    {
        return new self(
            sprintf("Score more than 100: %d", $score)
        );
    }
}
