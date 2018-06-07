<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PetCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pet Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-index">
    <div class="col-md-12">
        <div class="row">
            <div class="pull-right">
                <?= Html::a('Create Pet Category', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12">&nbsp;</div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                 <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'emptyCell' => '-',
                    'tableOptions' =>['class' => 'table table-striped table-bordered'],
                    'columns' => [
                        [
                         'class' => 'yii\grid\SerialColumn',
                         'header' => 'S.no',
                         'headerOptions' => ['width' => '50'],
                        ],

                       // 'pet_cat_id',
                        //'category_name',
                        [
                            'attribute'=>'category_name',
                            'label'=>'Pets Category',
                            'headerOptions' => ['width' => '200'],
                        ],
                        //'created_at',
                        //'updated_at',
                        [
                            'attribute'=>'created_at',
                            'label'=>'Created On',
                            'format'=>['date', 'php:Y/m/d H:i A'],//date,datetime, time
                            'headerOptions' => ['width' => '100'],
                        ],
                        [
                            'attribute'=>'updated_at',
                            'label'=>'Updated On',
                            'format'=>['date', 'php:Y/m/d H:i A'],//date,datetime, time
                            'headerOptions' => ['width' => '100'],
                        ],
                        [
                            'class' => 'backend\components\StatusColumn',
                            'attribute' => 'status',
                            'headerOptions' => ['width' => '100'],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Action',
                            'headerOptions' => ['width' => '100'],
                        ],
                    ],
                ]); ?>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
