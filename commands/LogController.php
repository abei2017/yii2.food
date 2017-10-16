<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/10/16
 * Time: 下午9:53
 */

namespace app\commands;

use Yii;
use app\models\Log;
use yii\console\Controller;

class LogController extends Controller
{
    public function actionClear(){
        Log::deleteAll();
    }

}