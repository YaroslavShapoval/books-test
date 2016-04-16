<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model app\models\Book
 * @var $form yii\widgets\ActiveForm
 */
?>

<div class="book-form">
    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php if ($model->previewUrl !== null): ?>
        <?= Html::img($model->previewUrl, [
            'style' => 'max-width: 200px; max-height: 200px;',
        ]) ?>
    <?php endif ?>

    <?= $form->field($model, 'previewFile')->fileInput() ?>

    <?= $form->field($model, 'author_id')->dropDownList(ArrayHelper::map(\app\models\Author::find()->all(), 'id', 'fullName'), [
        'prompt' => 'Автор',
    ]) ?>

    <?= $form->field($model, 'date')->widget(\kartik\date\DatePicker::className(), [
        'language' => 'ru',

        'pluginOptions' => [
            'orientation' => 'bottom left',
            'format' => 'yyyy-mm-dd',
            'autoclose' => true,
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
