<div class="blog-post">
    <h2 class="blog-post-title"><?php the_title(); ?></h2>
    <p class="blog-post-meta"><?php echo __('Categories: ' , 'slbgtheme'); the_category(', '); ?></p>
    <table class="table table-striped">
        <tr>
            <td>
                <?php echo esc_html(get_the_excerpt());
                $custom_field = get_post_meta(get_the_ID(), 'random_bytes', true);
                if (!empty($custom_field)) {
                    echo '<div class="meta_field">Some random bytes: ' . $custom_field . '</div>';
                }
                ?>
            </td>
            <td class = "image-cell">
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail(); }
                else {echo "<div class=\"missing-image\"><h3>No thumbnail</h3></div>";}?>
            </td>
        </tr>
    </table>


</div><!-- /.blog-post -->