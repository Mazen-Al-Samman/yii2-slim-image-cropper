<?php

namespace Samman\YiiSlimImageCropper;

use kartik\base\InputWidget;
use yii\helpers\Html;

class SlimImageCropper extends InputWidget
{
    // CONSTANTS
    const TYPE_FILE = 'file';

    // PROPERTIES
    public $id = 'slimCropper';
    public $ratio = "input";
    public $label = "Drop your avatar here";
    public $dataSize = [600, 400];

    public function init()
    {
        parent::init();
        $this->getView()->registerJsVar('slimId', $this->id);
        SlimImageCropperAssets::register($this->getView());
    }

    public function run()
    {
        $inputName = $this->model->formName() . "[$this->attribute]";
        $content = [];
        $content[] = Html::beginTag('div', [
            'class' => 'slim rounded bg-light border p-5',
            'data-ratio' => $this->ratio,
            'data-label' => $this->label,
            'data-service-format' => self::TYPE_FILE,
            'data-push' => true,
            'data-default-input-name' => $inputName,
            'data-size' => implode(',', $this->dataSize),
            'data-upload-base64' => false,
        ]);
        $content[] = Html::endTag('div');
        return implode("\n", $content);
    }
}