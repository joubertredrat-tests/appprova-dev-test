<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace AppProva\Domain\Exception\Course;

/**
 * NotFound Exception
 *
 * @package AppProva\Domain\Exception\Course
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
            sprintf("Course not found on database: %d", $id)
        );
    }
}
