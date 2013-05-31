<?php

class SiteController extends Controller
{


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		echo "hello world";
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
        header('HTTP/1.1 404 Not Found');
	}


}