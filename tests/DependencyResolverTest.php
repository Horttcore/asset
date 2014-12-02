<?php namespace Orchestra\Asset\TestCase;

use Orchestra\Asset\DependencyResolver;

class DependencyResolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test Orchestra\Asset\DependencyResolver::arrange() method.
     *
     * @test
     */
    public function testArrangeMethod()
    {
        $stub = new DependencyResolver;

        $output = array(
            'app' => array(
                'source'       => 'app.min.js',
                'dependencies' => array('jquery', 'bootstrap', 'backbone'),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
            'jquery-ui' => array(
                'source'       => 'jquery.ui.min.js',
                'dependencies' => array('jquery'),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
            'jquery' => array(
                'source'       => 'jquery.min.js',
                'dependencies' => array(),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
            'bootstrap' => array(
                'source'       => 'bootstrap.min.js',
                'dependencies' => array('jquery'),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
            'backbone' => array(
                'source'       => 'backbone.min.js',
                'dependencies' => array('jquery', 'zepto'),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
            'jquery.min' => array(
                'source'       => 'all.min.js',
                'dependencies' => array(),
                'attributes'   => array(),
                'replaces'     => array('jquery', 'jquery-ui'),
            ),
        );

        $expected = array(
            'jquery.min' => array(
                'source'       => 'all.min.js',
                'dependencies' => array(),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
            'bootstrap' => array(
                'source'       => 'bootstrap.min.js',
                'dependencies' => array(),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
            'backbone' => array(
                'source'       => 'backbone.min.js',
                'dependencies' => array(),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
            'app' => array(
                'source'       => 'app.min.js',
                'dependencies' => array(),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
        );

        $this->assertEquals($expected, $stub->arrange($output));
    }

    /**
     * Test Orchestra\Asset\DependencyResolver::arrange() method throws
     * exception given self dependence.
     *
     * @expectedException \RuntimeException
     */
    public function testArrangeMethodThrowsExceptionGivenSelfDependence()
    {
        $stub = new DependencyResolver;

        $output = array(
            'jquery-ui' => array(
                'source'       => 'jquery.ui.min.js',
                'dependencies' => array('jquery-ui'),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
        );

        $stub->arrange($output);
    }

    /**
     * Test Orchestra\Asset\DependencyResolver::arrange() method throws
     * exception given circular dependence.
     *
     * @expectedException \RuntimeException
     */
    public function testArrangeMethodThrowsExceptionGivenCircularDependence()
    {
        $stub = new DependencyResolver;

        $output = array(
            'jquery-ui' => array(
                'source'       => 'jquery.ui.min.js',
                'dependencies' => array('jquery'),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
            'jquery' => array(
                'source'       => 'jquery.min.js',
                'dependencies' => array('jquery-ui'),
                'attributes'   => array(),
                'replaces'     => array(),
            ),
        );

        $stub->arrange($output);
    }
}
