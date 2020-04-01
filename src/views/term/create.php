<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model umbalaconmeogia\m10ldict\models\Term */

$this->title = 'Create Term';
$this->params['breadcrumbs'][] = ['label' => 'Terms', 'url' => ['index', 'TermSearch[dict_id]' => $model->dict_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="term-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
