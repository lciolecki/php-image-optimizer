<?php

namespace Extlib\Tools\Png\OptiPng;

class OptiPng extends \PHPImageOptim\Tools\Png\OptiPng
{

    public function optimise()
    {
        exec($this->binaryPath . ' -i0 -o7' . $this->imagePath, $aOutput, $iResult);
        if ($iResult != 0) {
            throw new Exception('OPTIPNG was unable  to optimise image, result:' . $iResult . ' File: ' . $this->imagePath);
        }

        return $this;
    }
}
