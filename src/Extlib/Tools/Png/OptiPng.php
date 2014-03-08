<?php

namespace Extlib\Tools\Png;

/**
 * OptiPng png tool, extends for \PHPImageOptim\Tools\Png\OptiPng do simple command
 *  
 * @category    Extlib
 * @package     ImageOptimizer
 * @author      Lukasz Ciolecki <ciolecki.lukasz@gmail.com>
 * @copyright   Copyright (c) 2014 Lukasz Ciolecki (mart)
 */
class OptiPng extends \PHPImageOptim\Tools\Png\OptiPng
{

    public function optimise()
    {
        exec($this->binaryPath . ' ' . $this->imagePath, $aOutput, $iResult);
        if ($iResult != 0) {
            throw new Exception('OPTIPNG was unable  to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }
}
