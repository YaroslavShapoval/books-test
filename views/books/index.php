<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $this yii\web\View
 * @var $searchModel app\models\search\BookSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'label' => '#',
            ],

            [
                'attribute' => 'preview',
                'format' => 'raw',
                'value' => function(\app\models\Book $order) {
                    return \dosamigos\gallery\Gallery::widget([
                        'items' => [
                            'url' => $order->previewUrl,
                        ],
                        'options' => [
                            'class' => 'gallery-parent',
                        ],
                    ]);
                },
            ],

            'name',

            [
                'attribute' => 'author_id',
                'value' => function(\app\models\Book $order) {
                    return $order->author->fullName;
                },
            ],

            [
                'attribute' => 'date',
                'format' => 'raw',
                'value' => function(\app\models\Book $book) {
                    return Yii::$app->formatter->asDate($book->date) . '<br>'
                            . '('
                            . Yii::$app->formatter->asRelativeTime($book->date, 'now')
                            . ')';
                },
            ],

            [
                # See \yii\grid\ActionColumn::initDefaultButtons
                'class' => yii\grid\ActionColumn::className(),
                'buttons' => [
                    'view' => function ($url) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'View'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                            'class' => 'modal-view-button',
                        ]);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>

<?php
yii\bootstrap\Modal::begin(['id' =>'modal-ajax-view']);
yii\bootstrap\Modal::end();
?>