<?php get_header(); ?>
<div class="container-fluid">
<?php
                while (have_posts()) {
                    the_post();
                    echo "<div class='hero'>";
                    echo '<nav class="woocommerce-breadcrumb">';
                    get_breadcrumb();
                    echo '</nav>';
                    the_title(
                        sprintf('<h1 class="page-title">'),
                        '</h1>'
                    );
                    echo "</div>";
                    the_content();
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                }
?>
			</div>
<?php get_footer(); ?>