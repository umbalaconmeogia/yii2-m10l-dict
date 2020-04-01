<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model umbalaconmeogia\m10ldict\models\Term */
/* @var $form yii\widgets\ActiveForm */
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
    </div>

    <?php ActiveForm::end(); ?>

</div>
