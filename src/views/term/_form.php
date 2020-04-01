<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model umbalaconmeogia\m10ldict\models\Term */
/* @var $form yii\widgets\ActiveForm */
$this->params['fluid'] = TRUE;
?>

<div class="term-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dict_id')->hiddenInput()->label(FALSE) ?>

    <table class="table">
        <tr>
            <th></th>
            <?php foreach ($model->translationAttributes() as $translationAttribute) { ?>
                <th><?= $model->getAttributeLabel($translationAttribute) ?></th>
            <?php } ?>
        </tr>
        <tr>
            <th>Translation</th>
            <?php foreach ($model->translationAttributes() as $translationAttribute) { ?>
                <td><?= $form->field($model, "{$translationAttribute}[translation]")->textInput()->label(FALSE) ?></td>
            <?php } ?>
        </tr>
        <tr>
            <th>Pronunciation</th>
            <?php foreach ($model->translationAttributes() as $translationAttribute) { ?>
                <td><?= $form->field($model, "{$translationAttribute}[pronunciation]")->textInput()->label(FALSE) ?></td>
            <?php } ?>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?php if ($model->id) { ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
