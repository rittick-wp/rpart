<?php
global $product;
$product = wc_get_product(get_the_ID());
?>

<div class="quick-view-container">
<?php wc_get_template_part('content', 'single-product'); ?>
</div>