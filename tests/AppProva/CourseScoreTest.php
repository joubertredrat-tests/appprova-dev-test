<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests\AppProva;

use Tests\AppBundleTestCase;

/**
 * CourseScore Test
 *
 * @package Tests\AppProva
 */
class CourseScoreTest extends AppBundleTestCase
{
    /**
     * test AddInstitutionCourseScore
     *
     * @return void
     */
    public function testAddInstitutionCourseScore(): void
    {
        $score = 80;

        self::assertSame($score, null);
    }
}
