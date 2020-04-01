<?php

use umbalaconmeogia\m10ldict\models\Term;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel umbalaconmeogia\m10ldict\models\TermSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Terms';
$this->params['breadcrumbs'][] = $this->title;
$this->params['fluid'] = TRUE;
$columns = [];

foreach ($searchModel->dictionary->languages as $language) {
    $columns[] = [
        'header' => $language->name,
        'attribute' => Term::translationAttributeOf($language) . '.translation',
    ];
}
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{update}',
];
?>
<div class="term-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Term', ['create', 'Term[dict_id]' => $searchModel->dict_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
    ]); ?>


</div>
