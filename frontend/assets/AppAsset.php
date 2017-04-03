<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/font-awesome.css'
    ];
    public $js = [
        'js/bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    //定义按需加载JS方法，注意加载顺序在最后
    public static function addJs($view, $jsfile)
    {
        $view->registerJsFile(
            $jsfile,
            [
                AppAsset::className(),
                "depends" => "frontend\assets\AppAsset"
            ]
        );
    }
    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile)
    {
        $view->registerCssFile(
            $cssfile,
            [
            AppAsset::className(),
            "depends" => "frontend\assets\AppAsset"
            ]
        );
    }
}
