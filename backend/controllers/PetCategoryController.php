<?php

namespace backend\controllers;

use common\models\PetCategory;
use common\models\PetCategorySearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * PetCategoryController implements the CRUD actions for PetCategory model.
 */
class PetCategoryController extends Controller
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
     * Lists all PetCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PetCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PetCategory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PetCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $imgpath='';
        $model = new PetCategory();
        $model->created_at = time();
        $model->updated_at = time();
        $basePath=Yii::getAlias('@rootpath').DIRECTORY_SEPARATOR;
        $uploadDir = 'frontend/web/uploads/petcat/';
        if ($model->load(Yii::$app->request->post()))
        {
            if ($cat_image = UploadedFile::getInstance($model, 'category_image')){ 
                    $randno = rand(11111, 99999);
                    $imgpath = $basePath.$uploadDir. $randno . $cat_image->name;
                    $model->category_image = $randno . $cat_image->name;

                } else {
                    $model->category_image = 'default.jpg';
                }

            if ($model->save()) {
                
                if(!empty($imgpath))
                $cat_image->saveAs($imgpath);
                //return $this->redirect(['view', 'id' => $model->pet_cat_id]);
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PetCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at = time();
        $basePath=Yii::getAlias('@rootpath').DIRECTORY_SEPARATOR;
        $uploadDir = 'frontend/web/uploads/petcat/';
        $pimage=$model->category_image;
        $imgpath='';
        if ($model->load(Yii::$app->request->post()))
        {
            if ($cat_image = UploadedFile::getInstance($model, 'category_image')){ 
                $randno = rand(11111, 99999);
                $imgpath = $basePath.$uploadDir. $randno . $cat_image->name;
                $model->category_image = $randno . $cat_image->name;
                
            } else {
                $model->category_image = $pimage;
            }
            if($model->save())
            {
                if(!empty($imgpath))
                {
                    $cat_image->saveAs($imgpath);
                    if($pimage!="default.jpg" && $pimage!='')
                    {
                        $oldimg=$basePath.$uploadDir.$pimage;
                        if(file_exists($oldimg))
                        unlink($oldimg);
                    }
                }
                return $this->redirect(['index']);
                //return $this->redirect(['view', 'id' => $model->pet_cat_id]);
            }
        }
        
        
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PetCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $basePath=Yii::getAlias('@rootpath').DIRECTORY_SEPARATOR;
        $uploadDir = 'frontend/web/uploads/petcat/';
        $pimage=$model->category_image;
        
        if($model->delete())
        {
            if($pimage!="default.jpg" && $pimage!='')
            {
                $oldimg=$basePath.$uploadDir.$pimage;
                if(file_exists($oldimg))
                unlink($oldimg);
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the PetCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PetCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PetCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
