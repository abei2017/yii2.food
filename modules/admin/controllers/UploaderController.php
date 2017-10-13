<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/13
 * Time: 下午12:55
 */

namespace app\modules\admin\controllers;

use Yii;
use app\models\N8Folder;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\base\Exception;

class UploaderController extends N8Base {

    public $enableCsrfValidation = false;

    /**
     * 简单上传
     * @param $type string 类型
     * @param $name string 文件名
     * @param $exts boolean | string 扩展名
     * @throws Exception
     * @return array
     */
    public function actionSimple($type = 'data',$name = 'file',$exts = false){
        try {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $image = UploadedFile::getInstanceByName($name);
            if(empty($image)){
                throw new Exception('上传失败');
            }

            $ext = $image->getExtension() ? $image->getExtension() : 'png';

            if($exts && !in_array($ext,explode(',',$exts))){
                throw new Exception("您只能上传{$exts}类型文件");
            }

            $pathResult = N8Folder::createItemPath($type,$ext);
            $image->saveAs($pathResult['save_path']);

            return ['done'=>true,'file_path'=>$pathResult['web_path']];
        }catch(Exception $e){
            return ['done'=>false,'error'=>$e->getMessage()];
        }
    }
}