<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model app\models\Book
 */

$this->title = '#' . $model->primaryKey . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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

            [
                'attribute' => 'author_id',
                'value' => $model->author->fullName,
            ],

            'date:date',

            [
                'attribute' => 'preview',
                'format' => 'raw',
                'value' => \dosamigos\gallery\Gallery::widget([
                    'items' => [
                        'url' => $model->previewUrl,
                    ],
                    'options' => [
                        'class' => 'gallery-parent',
                    ],
                ]),
            ],
        ],
    ]) ?>

</div>
