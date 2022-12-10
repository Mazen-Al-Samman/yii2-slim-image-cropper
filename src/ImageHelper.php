<?php

namespace Samman\YiiSlimImageCropper;

use yii\helpers\FileHelper;
use yii\helpers\Json;

class ImageHelper
{
    const KEY_IMAGE = 'image';
    const KEY_IMAGE_NAME = 'name';
    const KEY_OUTPUT = 'output';
    const KEY_INPUT = 'input';
    const BASE_64_PATTERN = '/data:image\/(.+);base64,(.*)/';

    public static function save($base64Object, $path, $fileName = null)
    {
        $fullPath = \Yii::getAlias($path);
        FileHelper::createDirectory($fullPath, 0777);
        $base64Array = Json::decode($base64Object);
        $base64Image = $base64Array[self::KEY_OUTPUT][self::KEY_IMAGE];
        preg_match(self::BASE_64_PATTERN, $base64Image, $matches);
        if($matches) {
            $imageExtension = $matches[1];
            $encodedImageData = $matches[2];
        } else {
            $orginalName = $base64Array[self::KEY_INPUT][self::KEY_IMAGE_NAME];
            $imageExtension = substr($orginalName, strrpos($orginalName, '.') + 1);
            $encodedImageData = explode(';',$base64Image, 2)[1];
        }
        $decodedImageData = base64_decode($encodedImageData);

        if (empty($fileName)) {
            $fileName = \Yii::$app->security->generateRandomString(10);
        }
        file_put_contents("{$fullPath}/{$fileName}.{$imageExtension}", $decodedImageData);
        return "{$fileName}.{$imageExtension}";
    }
}
