<?php

class BlogPostController extends Controller
{
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
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
            array('allow',  // allow authenticated users to perform CRUD actions if email is verified
                'actions' => array('index', 'view', 'create', 'update', 'delete'),
                'expression' => 'isset(Yii::app()->user->email_verified) && Yii::app()->user->email_verified == 1',
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

   

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'author_id=:author_id';
        $criteria->params = array(':author_id' => Yii::app()->user->id);
        $dataProvider = new CActiveDataProvider('BlogPost', array('criteria' => $criteria));
        $this->render('index', array('dataProvider' => $dataProvider));
    }
    
    
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        if ($model->author_id != Yii::app()->user->id) {
            throw new CHttpException(403, 'You are not authorized to view this post.');
        }
        $this->render('view', array('model' => $model));
    }
    
    public function actionCreate()
    {
        $model = new BlogPost;
    
        if (isset($_POST['BlogPost'])) {
            $model->attributes = $_POST['BlogPost'];
            $model->author_id = Yii::app()->user->id; // Set the author to the currently logged-in user
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
    
        $this->render('create', array('model' => $model));
    }
    
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
    
        if ($model->author_id != Yii::app()->user->id) {
            throw new CHttpException(403, 'You are not authorized to update this post.');
        }
    
        if (isset($_POST['BlogPost'])) {
            $model->attributes = $_POST['BlogPost'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
    
        $this->render('update', array('model' => $model));
    }
    
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
    
        if ($model->author_id != Yii::app()->user->id) {
            throw new CHttpException(403, 'You are not authorized to delete this post.');
        }
    
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model->delete();
    
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        } else {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }
    
    public function loadModel($id)
    {
        $model = BlogPost::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
    

    /**
     * Performs the AJAX validation.
     * @param BlogPost $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='blog-post-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
