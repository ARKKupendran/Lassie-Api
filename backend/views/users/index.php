<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-index">
    <div class="col-md-12">
        <div class="row">
            <div class="pull-right">
                <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12">&nbsp;</div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        //'showOnEmpty'=>false,
                        'emptyCell' => '-',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            'username',
                            // 'auth_key',
                            //  'password',
                            'email:email',
                            // 'profile_image',
                            [
                                'attribute' => 'profile_image',
                                'format' => 'html',
                                'label' => 'Profile Picture',
                                'value' => function ($data) {
                                    return Html::img('/uploads/images/' . $data['profile_image'], ['width' => '60px']);
                                },
                            ],
                            /*[
                                'attribute' => 'status',
                                'format' => 'html',
                                'label' => 'Is Active',
                                'value' => function ($data) {
                                    if ($data['status'])
                                        return "<button class='btn-info btn'>Active</button>";
                                    else
                                        return "Not Active";
                                },
                            ],*/
                            [
                                'class' => 'backend\components\StatusColumn',
                                'attribute' => 'status',
                            ],
                            ['class' => 'yii\grid\ActionColumn',
                                'header' => 'Action',
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
