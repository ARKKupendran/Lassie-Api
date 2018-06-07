<?php

namespace backend\controllers;

use common\models\Users;
use common\models\UsersSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
             'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'actions' => [''],
                        'allow' => true,
                    ],
                        [
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id='')
    {
        if(empty($id))
            return $this->redirect(['index']);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $imgpath='';
        $model = new Users();
        $model->scenario = 'register';
        $basePath=Yii::getAlias('@rootpath').DIRECTORY_SEPARATOR;
        $uploadDir = 'frontend/web/uploads/images/';
        if($model->load(Yii::$app->request->post()))
        {
            $post = Yii::$app->request->post();
            $password = (isset($post['password'])) ? $post['password'] : '';
            $model->auth_key = $model->generateAuthKey();
            $model->password = $model->setPassword($password);
            if ($profile_image = UploadedFile::getInstance($model, 'profile_image')){ 
                $randno = rand(11111, 99999);
                $imgpath = $basePath.$uploadDir. $randno . $profile_image->name;
                $model->profile_image = $randno . $profile_image->name;
                
            } else {
                $model->profile_image = 'default.png';
            }
            if ($model->save()) 
            {
                if(!empty($imgpath))
                $profile_image->saveAs($imgpath);

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id='')
    {
        if(empty($id))
            return $this->redirect(['index']);
        
        $model = $this->findModel($id);
        $model->scenario='update';
        $basePath=Yii::getAlias('@rootpath').DIRECTORY_SEPARATOR;
        $uploadDir = 'frontend/web/uploads/images/';
        $old_password=$model->password;
        $pimage=$model->profile_image;
        $email=$model->email;
        if ($model->load(Yii::$app->request->post()))
        {
            $new_password=$model->password;
            if($old_password==$new_password)
                $model->password=$old_password;
            else    
                $model->password=$model->setPassword($new_password);
            if ($profile_image = UploadedFile::getInstance($model, 'profile_image')){ 
                $randno = rand(11111, 99999);
                $imgpath = $basePath.$uploadDir. $randno . $profile_image->name;
                $model->profile_image = $randno . $profile_image->name;
                
            } else {
                $model->profile_image = $pimage;
            }
            
            if($model->save())
            {
                if(!empty($imgpath))
                {
                    $profile_image->saveAs($imgpath);
                    if($pimage!="default.png")
                    {
                        $oldimg=$basePath.$uploadDir.$pimage;
                        unlink($oldimg);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
                
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
