<?php

namespace ExtlibTest;

/**
 * Tests for Extlib\ImageOptimizerTest
 * 
 * @author      Lukasz Ciolecki <ciolecki.lukasz@gmail.com>
 * @copyright   Copyright (c) 2013 Lukasz Ciolecki (mart)
 */
class ImageOptimizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test files
     * 
     * @return array
     */
    public function files()
    {
        return array(
            [APPLICATION_PATH . '/../resources/jpg.JPG', true],
            [APPLICATION_PATH . '/../resources/png.png', true],
            //[APPLICATION_PATH . '/../resources/gif.gif', true],
            [APPLICATION_PATH . '/../resources/php.php', false],
        );
    }
    
    
    /**
     * Tests method
     * 
     * @dataProvider files
     */
    public function tests($file, $expected)
    {
        $optimizer = new \Extlib\ImageOptimizer();
        $this->assertEquals($expected, $optimizer->optimize($file));
    }
}
