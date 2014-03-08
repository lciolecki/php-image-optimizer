<?php

namespace Extlib;

use PHPImageOptim\PHPImageOptim;
use Extlib\Tools\Png\OptiPng;
use PHPImageOptim\Tools\Jpeg\JpegOptim;
use PHPImageOptim\Tools\Gifsicle;

/**
 * Image file optimizer, uses https://github.com/bensquire/php-image-optim
 * 
 * @category    Extlib
 * @package     ImageOptimizer
 * @author      Lukasz Ciolecki <ciolecki.lukasz@gmail.com>
 * @copyright   Copyright (c) 2014 Lukasz Ciolecki (mart)
 */
class ImageOptimizer
{
    const TYPE_PNG = 'image/png';
    const TYPE_JPEG = 'image/jpeg';
    const TYPE_GIF = 'image/gif';
    
    /* Default image optimizators */
    const OPTIMIZER_OPTIPNG = 'optipng';
    const OPTIMIZER_JPEGOPTIM = 'jpegoptim';
    const OPTIMIZER_GIFSICLE = 'gifsicle';

    /**
     * Binary paths optimizators
     * 
     * @var array
     */
    protected $binaryPaths = array(
        self::OPTIMIZER_OPTIPNG => '/usr/bin/optipng',
        self::OPTIMIZER_JPEGOPTIM => '/usr/bin/jpegoptim',
        self::OPTIMIZER_GIFSICLE => '/usr/bin/gifsicle'
    );

    /**
     * Instance of png / gif optimizator
     * 
     * @var \PHPImageOptim\Tools\Png\OptiPng
     */
    protected $optiPng = null;
    
    /**
     * Instance of jpeg optimizator
     *
     * @var \PHPImageOptim\Tools\Jpeg\JpegOptim 
     */
    protected $jpegOptim = null;
    
    /**
     *
     * @var \PHPImageOptim\Tools\Gifsicle
     */
    protected $gifsicle = null;
    
    /**
     * Instance of construct
     * 
     * @param array $binaryPaths
     */
    function __construct(array $binaryPaths = array())
    {
        $this->binaryPaths = array_merge($this->binaryPaths, $binaryPaths);
               
        
       
        
        $this->optiPng = new OptiPng();
        $this->optiPng->setBinaryPath($this->binaryPaths[self::OPTIMIZER_OPTIPNG]);
        
        $this->jpegOptim = new JpegOptim();
        $this->jpegOptim->setBinaryPath($this->binaryPaths[self::OPTIMIZER_JPEGOPTIM]);
    }
    
    /**
     * Optimize file
     * 
     * @param string $path
     * @return boolean
     */
    public function optimize($path)
    {
        $optim = new PHPImageOptim();
        $optim->setImage($path);
        
        $type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $path);
        switch ($type) {
            case self::TYPE_JPEG:
                $optim->chainCommand($this->jpegOptim);
                break;
            case self::TYPE_GIF:
            case self::TYPE_PNG:
                $optim->chainCommand($this->optiPng);
                break;
            default:
                return false;
        }

        return $optim->optimise();
    }
}
