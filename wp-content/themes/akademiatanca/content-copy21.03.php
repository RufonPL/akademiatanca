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
        <h6><?php the_time('d.m.Y'); ?></h6>
        <?php $category = get_the_category(); ?>
        <?php if($category) : ?>
        <h6 class="news-category"><?php echo $category[0]->name; ?></h6>
        <?php endif; ?>
        <h5><strong><?php the_title(); ?></strong></h5>
        <span class="bar"></span>
        <a href="<?php the_permalink(); ?>" class="more-link"><strong>czytaj całość</strong><i class="fa fa-angle-double-right"></i></a>
    </div><!--end news item info-->
</div><!--end news item-->
