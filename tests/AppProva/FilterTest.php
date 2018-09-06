<?php
/**
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests\AppProva;

use Tests\AppBundleTestCase;

/**
 * Filter Test
 *
 * @package Tests\AppProva
 */
class FilterTest extends AppBundleTestCase
{
    /**
     * test FilterByInstitutionName
     *
     * @return void
     */
    public function testFilterByInstitutionName(): void
    {
        $filter = "Universidade";
        $results = 2;

        self::assertEquals($results, null);
        self::assertStringStartsWith($filter, null);
        self::assertStringStartsWith($filter, null);
    }
}
