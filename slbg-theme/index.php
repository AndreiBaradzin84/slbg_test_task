<?php get_header(); ?>

<div class="row">
    <div class="blog-main">
    </div>
        <?php get_sidebar(); ?>
    <div class="blog-main" id="blog-main-container">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                get_template_part('content', get_post_format());
            endwhile;
        endif;
        ?>
        <nav>
            <ul class="pager">
                <li><?php previous_posts_link(__('Prev posts', 'slbgtheme')); ?></li>
                <li><?php next_posts_link(__('Next posts', 'slbgtheme')); ?></li>
            </ul>
        </nav>
    </div><!-- /.blog-main -->

</div><!-- /.row -->
<?php get_footer(); ?>
