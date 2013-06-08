<?php

class SiteController extends Controller
{


	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			echo $error['message'];
		}
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

        $model->attributes = array('username'=>$_POST['username'], 'password'=>$_POST['password']);


        if($model->validate() && $model->login()) {
            /*
             * 登陆成功则返回user_id，客户端使用user_id通过/user/info接口取得用户信息
             * 客户端应该在本地保存用户信息的副本，这样直接使用user_id本地查询减少网络压力
             */
            $this->sendAjax(array('user_id'=>Yii::app()->user->id, 'nick_name'=>Yii::app()->user->name), true);
        } else {
            $this->sendAjax(null);
        }
//		// if it is ajax validation request
//		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
//		{
//			echo CActiveForm::validate($model);
//			Yii::app()->end();
//		}
//
//		// collect user input data
//		if(isset($_POST['LoginForm']))
//		{
//			$model->attributes=$_POST['LoginForm'];
//			// validate user input and redirect to the previous page if valid
//			if($model->validate() && $model->login())
//				$this->redirect(Yii::app()->user->returnUrl);
//		}
//		// display the login form
//		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
	}

    public function actionRegister() {
        $model = new RegisterForm();
       // echo "hello";
        $model->attributes = array('username'=>$_POST['username'], 'password'=>$_POST['password'], 'nick_name' => $_POST['nick_name']);
        $rtn = false;
       // echo $model->validate();
       // return;
        if($model->validate() && $model->save()) {
            $rtn = true;
        }
        $this->sendAjax($rtn, true);
    }
}


