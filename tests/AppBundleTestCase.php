<?php
/**
 * Dev Test
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

/**
 * AppBundleTestCase
 *
 * @package Tests
 */
class AppBundleTestCase extends TestCase
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $kernel = new \AppKernel("test", true);
        $kernel->boot();

        $this->container = $kernel->getContainer();
    }

    /**
     * @return Container
     */
    protected function getContainer(): Container
    {
        return $this->container;
    }
}
