<?php

namespace Extlib;

use PHPImageOptim\PHPImageOptim,
    PHPImageOptim\Tools\Jpeg\JpegOptim,
    PHPImageOptim\Tools\Gif\Gifsicle,
    PHPImageOptim\Tools\Png\OptiPng;

/**
 * Image file optimizer, uses https://github.com/bensquire/php-image-optim. 
 * Class try optimize image file (png, jpg, gif) require: optipng, jpegoptim, gifsicle.
 * 
 * - http://optipng.sourceforge.net/
 * - http://freecode.com/projects/jpegoptim
 * - http://www.lcdf.org/gifsicle/
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
     * @var \PHPImageOptim\Tools\Gif\Gifsicle
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
  
        $this->jpegOptim = new JpegOptim();
        $this->jpegOptim->setBinaryPath($this->binaryPaths[self::OPTIMIZER_JPEGOPTIM]);
        
        $this->optiPng = new OptiPng();
        $this->optiPng->setBinaryPath($this->binaryPaths[self::OPTIMIZER_OPTIPNG]);
        
        $this->gifsicle = new Gifsicle();
        $this->gifsicle->setBinaryPath($this->binaryPaths[self::OPTIMIZER_GIFSICLE]);
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
            case self::TYPE_PNG:
                $optim->chainCommand($this->optiPng);
                break;
            case self::TYPE_GIF:
                 //$optim->chainCommand($this->gifsicle);
                 return false;
                break;
            default:
                return false;
        }

        return $optim->optimise();
    }
    
    /**
     * Get png adapter
     * 
     * @return \PHPImageOptim\Tools\Png\OptiPng
     */
    public function getOptiPng()
    {
        return $this->optiPng;
    }

    /**
     * Get jpeg adapter
     * 
     * @return \PHPImageOptim\Tools\Jpeg\JpegOptim
     */
    public function getJpegOptim()
    {
        return $this->jpegOptim;
    }

    /**
     * Get gif adapter
     * 
     * @return \PHPImageOptim\Tools\Gif\Gifsicle
     */
    public function getGifsicle()
    {
        return $this->gifsicle;
    }

    /**
     * Set png adapter
     * 
     * @param \PHPImageOptim\Tools\Png\OptiPng $optiPng
     * @return \Extlib\ImageOptimizer
     */
    public function setOptiPng(\PHPImageOptim\Tools\Png\OptiPng $optiPng)
    {
        $this->optiPng = $optiPng;
        return $this;
    }

    /**
     * Set jpeg adapter
     * 
     * @param \PHPImageOptim\Tools\Jpeg\JpegOptim $jpegOptim
     * @return \Extlib\ImageOptimizer
     */
    public function setJpegOptim(\PHPImageOptim\Tools\Jpeg\JpegOptim $jpegOptim)
    {
        $this->jpegOptim = $jpegOptim;
        return $this;
    }

    /**
     * Set gif adapter
     * 
     * @param \PHPImageOptim\Tools\Gif\Gifsicle $gifsicle
     * @return \Extlib\ImageOptimizer
     */
    public function setGifsicle(\PHPImageOptim\Tools\Gif\Gifsicle $gifsicle)
    {
        $this->gifsicle = $gifsicle;
        return $this;
    }
}
