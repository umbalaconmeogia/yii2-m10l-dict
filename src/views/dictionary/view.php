<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model umbalaconmeogia\m10ldict\models\Dictionary */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dictionaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dictionary-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Term', ['term/index', 'TermSearch[dict_id]' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Language', ['language/index', 'LanguageSearch[dict_id]' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description:ntext',
        ],
    ]) ?>

</div>
