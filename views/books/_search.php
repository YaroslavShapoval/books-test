<?php

use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model app\models\search\BookSearch
 * @var $form yii\widgets\ActiveForm
 */
?>

<div class="book-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name') ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'author_id')->dropDownList(ArrayHelper::map(\app\models\Author::find()->all(), 'id', 'fullName'), [
                'prompt' => 'Автор',
            ]) ?>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label">Дата выхода книги</label>

                <?= DatePicker::widget([
                    'model' => $model,
                    'form' => $form,
                    'type' => DatePicker::TYPE_RANGE,
                    'attribute' => 'dateFrom',
                    'attribute2' => 'dateTo',
                    'options' => ['placeholder' => 'Начальная дата'],
                    'options2' => ['placeholder' => 'Конечная дата'],
                    'language' => 'ru',
                    'separator' => '<i class="glyphicon glyphicon-resize-horizontal"></i>',

                    'pluginOptions' => [
                        'orientation' => 'bottom left',
                        'format' => 'yyyy-mm-dd',
                    ],
                ]) ?>
            </div>
        </div>
    </div>

    <div class="form-group text-right">
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
