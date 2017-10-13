<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2017/9/27
 * Time: 下午4:58
 */

namespace app\modules\admin\controllers;

use yii\web\Controller;

class N8Base extends Controller {
    public $menus;

    /**
     * 格式化菜单
     * @param $active
     * @param array $insert
     */
    protected function initActiveMenu($active,$insert = []){
        if($insert){
            $this->menus[$active] = $insert;
        }

        foreach($this->menus as $key=>&$menu){
            if($active == $key){
                $menu['active'] = true;
            }
        }

        $this->view->params['menus'] = $this->menus;
    }

    /**
     *
     * @param array $errors
     * @return string
     */
    protected function formatErrors($errors = []){
        return implode('<br/>',array_shift($errors));
    }


}