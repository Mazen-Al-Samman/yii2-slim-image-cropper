<?php

namespace Samman\YiiSlimImageCropper;

use kartik\base\InputWidget;
use yii\helpers\Html;

class SlimImageCropper extends InputWidget
{
    // PROPERTIES
    public $id = 'slimCropper';
    public $class = 'slim rounded bg-light border p-5';
    public $dataRatio = "3:2";
    public $dataServiceFormat = "file";
    public $label = "Drop your avatar here";
    public $dataSize = null;
    public $dataMinSize = null;
    public $dataForceSize = null;
    public $dataForceMinSize = false;
    public $dataPush = true;
    public $dataUploadBase64 = false;

    public $dataDefaultInputName;

    public function init()
    {
        parent::init();
        $this->getView()->registerJsVar('slimId', $this->id);
        SlimImageCropperAssets::register($this->getView());
        $this->dataDefaultInputName = $this->model->formName() . "[$this->attribute]";
    }

    public function run()
    {
        $content = [];
        $htmlAttributes = $this->getAttributes();
        $content[] = Html::beginTag('div', $htmlAttributes);
        $content[] = Html::endTag('div');
        return implode("\n", $content);
    }

    private function getAttributes()
    {
        $attributesArray = [];
        $vars = $this->attributes();
        foreach ($vars as $varName) {
            $attributeName = $this->formatVarName($varName);
            $attributesArray[$attributeName] = $this->getAttributeValue($this->{$varName});
        }
        return array_filter($attributesArray);
    }

    public function attributes()
    {
        $class = new \ReflectionClass($this);
        $names = [];
        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if ($property->class == SlimImageCropper::class) {
                $names[] = $property->getName();
            }
        }

        return $names;
    }

    private function getAttributeValue($varValue)
    {
        switch (gettype($varValue)) {
            case 'integer':
            case 'double':
                return (string) $varValue;
            case 'array':
                return implode(',', $varValue);
            case 'string':
                return $varValue;
            case 'boolean':
                return $varValue ? 'true' : 'false';
            default:
                return null;
        }
    }

    private function formatVarName($varName)
    {
        return  strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $varName));
    }
}