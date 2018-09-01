<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests\AppProva;

use Tests\AppBundleTestCase;

/**
 * Course Test
 *
 * @package Tests\AppProva
 */
class CourseTest extends AppBundleTestCase
{
    /**
     * test CourseCreate
     *
     * @return void
     */
    public function testCourseCreate(): void
    {
        $name = "Sistemas de Informação";

        self::assertEquals($name, null);
    }
}
