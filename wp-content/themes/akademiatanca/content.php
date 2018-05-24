<?php
/**
 * @author Rafał Puczel
 */
?>

				 
<div class="news-item col-md-4 col-sm-6 col-xs-6" id="post-<?php the_ID(); ?>">
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
