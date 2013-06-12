<?php

class DefaultController extends AController
{

	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionAdd() {
        $this->render("add");
    }



}