<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model umbalaconmeogia\m10ldict\models\Dictionary */

$this->title = 'Create Dictionary';
$this->params['breadcrumbs'][] = ['label' => 'Dictionaries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
