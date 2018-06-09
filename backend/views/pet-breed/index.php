<?php

use common\models\PetBreedSearch;
use common\models\PetCategory;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel PetBreedSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Pet Breeds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pet-breed-index">
    <div class="col-md-12">
        <div class="row">
            <div class="pull-right">
                <?= Html::a('Create Pet Breed', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            //'id',
                            [
                                'attribute' => 'main_cat_id',
                                'value' => 'mainCat.category_name',
                                'filter' => Html::activeDropDownlist($searchModel, 'main_cat_id', ArrayHelper::map(\common\models\PetCategory::find()->where('status=:id', ['id' => 1])->all(), 'pet_cat_id', 'category_name'), ['class' => 'form-control', 'id' => null, 'prompt' => 'All']),
                            ],
                            //'main_cat_id',
                            'bread_name',
                            'created_at',
                            'updated_at',
                            //'status',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
