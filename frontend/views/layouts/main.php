<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => 'computer.shop',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-light bg-light',
        ],
    ]);
    $menuItems = [
        ['label' => 'Каталог', 'url' => ['/site/index']],
        ['label' => 'Магазины', 'url' => ['/site/about']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);


    echo Nav::widget([
        'items' => [
            '<form class="form-inline my-2 my-lg-0" action="' . Url::to(['/site/search']) . '" method="get">
                <input class="mr-sm-2" type="search" placeholder="Поиск" aria-label="Search" name="q">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
            </form>',
        ],
        'encodeLabels' => false,
    ]);

    if (Yii::$app->user->isGuest) {
        echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
    } else {
        echo Html::a('<img src="/uploads/icons/cart.png" alt=cart" style="width: 30px; height: 30px; margin-left: 10px;">', ['/site/page1']);
        echo Html::a('<img src="/uploads/icons/favorite.png" alt="favorite" style="width: 30px; height: 30px; margin-left: 10px;">', ['/site/page1']);
        echo Html::a('<img src="/uploads/icons/profile.png" alt="profile" style="width: 30px; height: 30px; margin-left: 10px;">', ['/site/page1']);

//        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link text-decoration-none']
//            )
//            . Html::endForm();
    }

    NavBar::end();
    ?>
</header>


<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; computer.shop <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
