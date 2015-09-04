<?php foreach ($categories as $category) {
  echo '<h3>'.$category['name'].'</h3>';
}?>
<div class="row">
      <div class="pull-right">
        <?php foreach ($categories as $category) { ?>
              <a href="<?php echo $category['href']; ?>">Xem tất cả</a>
            <?php } ?>
          </div>
        <?php foreach ($products as $product) { ?>
        <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="product-thumb transition">
          <div class="image">
            <a href="<?php echo $product['href']; ?>">
            <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
            </a>
          </div>

          <div class="caption">
            <h4><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h4>
            <p><?php echo $product['description']; ?></p>
              <?php if ($product['rating']) { ?>
              <div class="rating">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                         <?php if ($product['rating'] < $i) { ?>
                         <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                         <?php } else { ?>
                         <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                         <?php } ?>
                         <?php } ?>
              </div>
              <?php } //rating ?>
            <?php if ($product['price']) { ?>
                    <p class="price">
                      <?php if (!$product['special']) { ?>
                      <?php echo $product['price']; ?>
                      <?php } else { ?>
                      <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
                      <?php } ?>
                    <?php if ($product['tax']) { ?>
                      <span class="price-tax"><?php echo $product['tax']; ?> <?php echo $product['tax']; ?></span>
                    <?php } ?>
                    </p>
                    <?php } ?>
          </div><!--caption-->
          <div class="button-group">
              <button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-shopping-cart"></i> Mua hàng</button> 
              <button type="button" data-toggle="tooltip" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
              <button type="button" data-toggle="tooltip" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
          </div>
        </div><!--thumnail transition-->
      </div><!--product layout-->
      <?php } //end product ?>
  </div>