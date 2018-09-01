<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests\AppProva;

use Tests\AppBundleTestCase;

/**
 * Score Test
 *
 * @package Tests\AppProva
 */
class ScoreTest extends AppBundleTestCase
{
    /**
     * test AddScore
     *
     * @return void
     */
    public function testAddScore(): void
    {
        $institutionScore = 100;
        $courseGeneralScore = 100;
        $courseStudentAvgScore = 100;

        self::assertSame($institutionScore, null);
        self::assertSame($courseGeneralScore, null);
        self::assertSame($courseStudentAvgScore, null);
    }
}
