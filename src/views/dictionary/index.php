<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel umbalaconmeogia\m10ldict\models\DictionarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dictionaries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Dictionary', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{term} {view} {update}',
                'buttons' => [
                    'term' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>',
                            ['term/index', 'TermSearch[dict_id]' => $model->id],
                            [
                                'title' => Yii::t('app', 'Term'),
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>


</div>
