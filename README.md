PHP Image optimizer
===============

This is a simple PHP class for optimize image file uses https://github.com/bensquire/php-image-optim (png, jpeg, gif). Requires: optipng, jpegoptim, gifsicle

 * http://optipng.sourceforge.net
 * http://freecode.com/projects/jpegoptim
 * http://www.lcdf.org/gifsicle


##Installation using Composer

    {
        "require": {
            "lciolecki/php-image-optimizer": "dev-master"
        }
    }

## Sample use

    $optimizer = new \Extlib\ImageOptimizer(array(
        \Extlib\ImageOptimizer::OPTIMIZER_OPTIPNG => '/usr/bin/optipng',  //your_path
        \Extlib\ImageOptimizer::OPTIMIZER_JPEGOPTIM => '/usr/bin/jpegoptim', //your_path
        \Extlib\ImageOptimizer::OPTIMIZER_GIFSICLE => '/usr/bin/gifsicle' //your_path
    ));

    $optimizer->optimize("image.png"); //return true
    $optimizer->optimize("image.jpg"); //return true
    $optimizer->optimize("image.gif"); //return true
    $optimizer->optimize("file.txt"); //return false

If you don't have some one of packages: optipng, jpegoptim, gifsicle optimyzer throws Exception. For save uses take all code in try/catch block.
