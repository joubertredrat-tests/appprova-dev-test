<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Exception\Institution;

/**
 * InvalidGeneralScore Exception
 *
 * @package AppProva\Domain\Exception\Institution
 */
class InvalidGeneralScoreException extends \Exception
{
    /**
     * @param int $generalScore
     * @return InvalidGeneralScoreException
     */
    public static function lessThanZero(int $generalScore): self
    {
        return new self(
            sprintf("General score less than 0: %d", $generalScore)
        );
    }

    /**
     * @param int $generalScore
     * @return InvalidGeneralScoreException
     */
    public static function moreThanOneHundred(int $generalScore): self
    {
        return new self(
            sprintf("General score more than 100: %d", $generalScore)
        );
    }
}
