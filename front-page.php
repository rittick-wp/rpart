<?php get_header(); ?>

<section class="HeroInner">
	<div class="container-fluid">
		<div class="Heroslider">
          <ul class="slides">
            <li>
            	<img src="<?php echo get_theme_file_uri('/assets/images/Hero-1.jpg'); ?>" alt="hero image">
            	<div class="text">
            	<h1 class="page-title">No one shall be subjected to arbitrary arrest</h1>
                <p>No one shall be subjected to arbitrary arrest, detention or exile.</p>
                <a href="#" class="button">Shop Now</a>
                </div>
            </li>
            <li>
            	<img src="<?php echo get_theme_file_uri('/assets/images/Hero-2.jpg'); ?>" alt="hero image">
            	<div class="text">
            	<h1 class="page-title">No one shall be subjected to arbitrary arrest</h1>
                <p>No one shall be subjected to arbitrary arrest, detention or exile.</p>
                <a href="#" class="button">Shop Now</a>
            </div>
            </li>
            <li>
            	<img src="<?php echo get_theme_file_uri('/assets/images/Hero-3.jpg'); ?>" alt="hero image">
            	<div class="text">
            	<h1 class="page-title">No one shall be subjected to arbitrary arrest</h1>
                <p>No one shall be subjected to arbitrary arrest, detention or exile.</p>
                <a href="#" class="button">Shop Now</a>
            </div>
            </li>
            <li>
            	<img src="<?php echo get_theme_file_uri('/assets/images/Hero-4.jpg'); ?>" alt="hero image">
            	<div class="text">
            	<h1 class="page-title">No one shall be subjected to arbitrary arrest</h1>
                <p>No one shall be subjected to arbitrary arrest, detention or exile.</p>
                <a href="#" class="button">Shop Now</a>
            </div>
            </li>
          </ul>
        </div>
	</div>
</section>
<section class="categorys">
    <div class="container-fluid">
        <h2 class="title">Our Categories</h2>
            <div class="cat">
                <?php echo do_shortcode('[product_categories limit="8" parent="0"]'); ?>
            </div>
    </div>
</section>

<section class="deals">
    <div class="container-fluid">
        <h2 class="title">Todays Offers</h2>
        <a class="link" href="<?php get_category_link(40); ?>">View More</a>
        <?php echo do_shortcode('[products limit="4" columns="4" orderby="popularity" class="quick-sale" on_sale="true" ]'); ?>
    </div>
</section>

<section class="bestSelling">
    <div class="container-fluid">
        <h2 class="title">Best Selling Products</h2>
        <a class="link" href="<?php get_category_link(40); ?>">View More</a>
        <?php echo do_shortcode('[products limit="4" columns="4" best_selling="true" ]'); ?>
    </div>
</section>

<?php get_footer(); ?>