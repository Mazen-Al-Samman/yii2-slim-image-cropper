<?php

namespace Samman\YiiSlimImageCropper\assets;

use yii\web\AssetBundle;

class SlimImageCropperAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'library/slim.min.css',
    ];
    public $js = [
        'library/slim.min.js'
    ];
}