<style>
    body {
        background-color: #ebeced;
    }
    .card-link:hover .card {
        box-shadow: 0 0 20px rgba(0,0,0,0.3);
    }
    .card-link {
        text-decoration: none;
        color: inherit;
    }
</style>

<div class="product-card card border-0 shadow" style="width: 900px; height: 220px; padding: 10px; padding-left: 20px;">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="/uploads/categories/images.jpeg" class="card-img" alt="Изображение продукта" style="width: 200px; height: 200px; margin-right: 10px;">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="<?= Yii::$app->urlManager->createUrl(['shop/product/view', 'id' => 1]) ?>" class="text-decoration-none text-dark">Название продукта</a>
                </h5>
                <div class="d-flex justify-content-between align-items-center">
                    <p class="card-text" style="margin-bottom: 0;">Цена: $99.99</p>
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary">Избранное</button>
                        <button class="btn btn-primary">Купить</button>
                    </div>
                </div>
                <div class="rating" style="margin-top: 10px;">
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9733;</span>
                    <span class="star">&#9734;</span>
                </div>
            </div>
        </div>
    </div>
</div>