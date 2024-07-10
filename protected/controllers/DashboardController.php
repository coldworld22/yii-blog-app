<?php

class DashboardController extends Controller
{
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays the dashboard with a list of blog posts.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('BlogPost', array(
            'criteria' => array(
                'condition' => 'author_id=:author_id',
                'params' => array(':author_id' => Yii::app()->user->id),
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
}
