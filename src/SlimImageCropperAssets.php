<?php

namespace Samman\YiiSlimImageCropper;

use kartik\base\PluginAssetBundle;
use yii\web\AssetBundle;

class SlimImageCropperAssets extends PluginAssetBundle
{
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('js', ['slim.min']);
        $this->setupAssets('css', ['slim.min']);
        parent::init();
    }
}
