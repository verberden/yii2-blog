<?php
namespace app\assets;

use yii\web\AssetBundle;

class SelAsset extends AssetBundle
{
    public $sourcePath = '@vendor/kartik-v/yii2-widget-select2/assets';
    public $css = [
        'css/select2.css',
        'css/select2-addl.css',
        'css/select2-bootstrap.css',
        'css/select2-classic.css',
        'css/select2-default.css',
        'css/select2-krajee.css',
    ];
    public $js = [
        'js/select2.full.js',
        'js/select2-krajee.js'
    ];

}