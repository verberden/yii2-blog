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
class ImgcorpAsset extends AppAsset
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/imgareaselect/imgareaselect-default.css',
    ];
    public $js = [
        'scripts/imgareaselect/jquery.imgareaselect.pack.js',
        'scripts/getImgUrl.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}