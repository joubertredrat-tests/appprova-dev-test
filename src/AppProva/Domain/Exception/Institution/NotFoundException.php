<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Exception\Institution;

/**
 * NotFound Exception
 *
 * @package AppProva\Domain\Exception\Institution
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
            sprintf("Institution not found on database: %d", $id)
        );
    }
}

