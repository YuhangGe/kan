<?php

class SiteController extends Controller
{


	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
            if(Yii::app()->request->isAjaxRequest) {
                echo CJSON::encode(array("success"=>false));
            } else {
                $this->redirect(Yii::app()->params['url_prefix']."download.php");
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

            $m = new LocationForm();
            $m->attributes = $_POST;
            $m->user_id = $user->id;
            $m->time = time();
            $m->update();

            $rs = Setting::model()->findAllBySql("select * from setting where `key` in('advertisement_720', 'advertisement_768','big_advertisement_720','big_advertisement_768')");
            $ad_720 = null;
            $ad_768 = null;
            $big_ad_720 = null;
            $big_ad_768 = null;
            foreach($rs as $r) {
                if($r->key==="advertisement_720") {
                    $ad_720 = $r->value;
                } elseif($r->key==='advertisement_768') {
                    $ad_768 = $r->value;
                } elseif($r->key==="big_advertisement_720") {
                    $big_ad_720 = $r->value;
                } elseif($r->key==="big_advertisement_768") {
                    $big_ad_768 = $r->value;
                }

            }
            $this->sendAjax(array(
                'email'=>$user->email,
                'phone'=>$user->phone,
                'user_id'=>$user->id,
                'nick_name'=>$user->name,
                'small_avatar'=>$user->avatar,
                'level'=>$user->level,
                'sid'=>session_id(),
                'ad_url' => $ad_720,
                'ad_url_720'=>$ad_720,
                'ad_url_768'=>$ad_768,
                'big_ad_720' => $big_ad_720,
                'big_ad_768' => $big_ad_768
            ), true);
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


