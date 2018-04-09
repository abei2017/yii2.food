<?php
namespace app\models;

use Yii;

class Conf {

    static public function readConf($conf){
        $path = Yii::getAlias("@app").'/config/'.$conf.'.php';
        if(file_exists($path) == false){
            file_put_contents($path,self::varConf([]));
        }
        $v = include($path);
        return $v;
    }

    static public function writeConf($conf,$value){
        $confFile =Yii::getAlias("@app").'/config/'.$conf.'.php';
        file_put_contents($confFile,self::varConf($value));
    }

    static public function varConf($value){
        $v = "<?php \r\n return ";
        $v .= stripcslashes(var_export($value,true));
        $v .= ";\r\n";

        return $v;
    }
}