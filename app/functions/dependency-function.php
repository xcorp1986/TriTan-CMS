<?php
use Spatie\ImageOptimizer\OptimizerChainFactory;
use TriTan\Common\Hooks\ActionFilterHook as hook;

/**
 * TriTan CMS Global Scope Functions.
 *
 * @license GPLv3
 *
 * @since 0.9
 * @package TriTan CMS
 * @author Joshua Parker <joshmac3@icloud.com>
 */

/**
 * Sets up object cache global scope and assigns it based on
 * the type of caching system used.
 *
 * @file app/functions/global-function.php
 *
 * @since 0.9
 */
function _ttcms_cache_init()
{
    $driver = hook::getInstance()->{'applyFilter'}('ttcms_cache_driver', 'json');
    $cache = new \TriTan\Cache\Object_Cache($driver);
    return $cache;
}

/**
 * Sets up PHPMailer global scope.
 *
 * @file app/functions/global-function.php
 *
 * @since 0.9
 * @param bool $bool
 *            Set whether to use exceptions for error handling. Default: true.
 */
function _ttcms_phpmailer($bool = true)
{
    $phpMailer = new \PHPMailer\PHPMailer\PHPMailer($bool);
    return $phpMailer;
}

/**
 * Sets up TriTan CMS Email global scope.
 *
 * @file app/functions/global-function.php
 *
 * @since 0.9
 */
function _ttcms_email()
{
    $email = new \TriTan\Email();
    return $email;
}

/**
 * Sets up TriTan CMS Logger global scope.
 *
 * @file app/functions/global-function.php
 *
 * @since 0.9
 */
function _ttcms_logger()
{
    $logger = new \TriTan\Logger();
    return $logger;
}

/**
 * Sets up TriTan CMS Flash Messages global scope.
 *
 * @file app/functions/global-function.php
 *
 * @since 0.9
 */
function _ttcms_flash()
{
    $flash = new \TriTan\FlashMessages();
    return $flash;
}

/**
 * Sets up random number and string generator global scope.
 *
 * @file app/functions/global-function.php
 *
 * @since 0.9
 * @return type
 */
function _ttcms_random_lib()
{
    $factory = new \RandomLib\Factory;
    $generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::MEDIUM));
    return $generator;
}

/**
 * Image optimizer.
 *
 * @file app/functions/global-function.php
 *
 * @since 0.9
 * @param string $pathToImage       Path to original image.
 * @param string $pathToOptimizded  Path to where optimized image should be saved.
 * @return string Optimized image.
 */
function _ttcms_image_optimizer($pathToImage, $pathToOptimizded)
{
    $optimizerChain = OptimizerChainFactory::create();
    return $optimizerChain->setTimeout(30)->optimize($pathToImage, $pathToOptimizded);
}
