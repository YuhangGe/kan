<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function sendAjax($data, $success=true) {
        if($data !== null) {
            $out = array('data'=>$data, 'success'=>$success);
        } else {
            $out = array("success"=>false);
        }

        echo CJSON::encode($out);
        Yii::app()->end();
    }
}