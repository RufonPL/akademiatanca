<?php  
$see_also_news = new WP_Query(array(
	'post_type'		=> 'post',
	'posts_per_page'=> 6,
	'orderby' 		=> 'rand',
	'post__not_in' 	=> array(get_the_ID())
));
?>
<div class="see-also-news">
	<?php section_header('<p><strong>Zobacz także</strong></p><p>INFORMACJE</p>'); ?>
    
	<?php if($see_also_news->have_posts()) : ?>
   	<div class="row sa-news">
    	<?php while($see_also_news->have_posts()) : $see_also_news->the_post(); ?>
        <div class="news-item col-md-4 col-sm-6 col-xs-6">
            <div class="news-thumbnail pull-left">
            <?php if(has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('medium'); ?>
            <?php endif; ?>
            </div><!--end news thumbnail-->
            <div class="news-item-info">
                <span><?php the_time('d.m.Y'); ?></span><br/>
                <?php $category = get_the_category(); ?>
				<?php if($category) : ?>
                <span class="news-category"><?php echo $category[0]->name; ?></span>
                <?php endif; ?>
                <h5><strong><?php the_title(); ?></strong></h5>
                <span class="bar"></span>
                <a href="<?php the_permalink(); ?>" class="more-link"><img src="http://www.akademiatanca.com.pl/wp-content/themes/akademiatanca/images/czytaj.png" alt="czytaj więcej" class="more-link-img"/></a>
            </div><!--end news item info-->
        </div><!--end news item-->
        <?php endwhile; ?>
    </div><!--end row-->
    <?php endif; wp_reset_postdata(); ?>
</div><!--end see also news-->