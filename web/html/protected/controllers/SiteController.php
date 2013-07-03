<?php

class SiteController extends Controller
{


	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
            if(Yii::app()->request->isAjaxRequest) {
                echo $error->message;
            } else {
                $this->redirect(Yii::app()->params['link_prefix']."admin/default/index");
            }
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
            $user = Yii::app()->user;
            $this->sendAjax(array('user_id'=>$user->id, 'nick_name'=>$user->name, 'small_avatar'=>$user->avatar,'level'=>$user->level, 'sid'=>session_id()), true);
        } else {
            $this->sendAjax(null);
        }

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


