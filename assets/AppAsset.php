<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        /*'css/select2.css',
        'css/select2-addl.css',
        'css/select2-bootstrap.css',
        'css/select2-classic.css',
        'css/select2-default.css',
        'css/select2-krajee.css',*/
    ];
    public $js = [
        /*'js/select2.full.js',
        'js/select2-krajee.js'*/

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',

    ];
}
