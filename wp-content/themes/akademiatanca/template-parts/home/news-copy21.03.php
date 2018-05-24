<?php  
$s4_header 	= get_field('_s4_header');
$s4_limit	= get_field('_s3_limit');
$ppp = $s4_limit ? $s4_limit : 18;
?>
<?php  
$news = new WP_Query(array(
	'post_type'		=> 'post',
	'posts_per_page'=> esc_html($ppp),
));
?>
<div class="news">
	<?php section_header($s4_header); ?>
    
    <?php if($news->have_posts()) : ?>
    <?php 
	$all_news = $news->post_count;
	$slides = ceil($all_news/6);
	?>
    	<div id="news-slider" class="carousel slide">
        	<ol class="carousel-indicators">
				<?php for($i=0; $i<$slides; $i++) : ?>
                    <li data-target="#news-slider" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0): ?>active<?php endif; ?>">      
                <?php endfor; ?>
            </ol><!--end carousel indicators-->
        
        	<div class="carousel-inner">
            	<div class="item active">
                	<div class="news-slide row">
					<?php $n=1; while($news->have_posts()) : $news->the_post(); ?>
                        <div class="news-item col-md-4 col-sm-6 col-xs-6">
                            <div class="news-thumbnail pull-left">
                            <?php if(has_post_thumbnail()) : ?>
                            	<?php the_post_thumbnail('medium'); ?>
                            <?php endif; ?>
                            </div><!--end news thumbnail-->
                        	<div class="news-item-info">
                            	<h6><?php the_time('d.m.Y'); ?></h6>
                                <h5><strong><?php the_title(); ?></strong></h5>
                                <span class="bar"></span>
                                <a href="<?php the_permalink(); ?>" class="more-link"><strong>czytaj całość</strong><i class="fa fa-angle-double-right"></i></a>
                            </div><!--end news item info-->
                        </div><!--end news item-->
                <?php if($n%6==0 && $n!=$all_news) : ?>
                    </div><!--end news slide-->	
                </div><!--end item-->
                <div class="item">
                	<div class="news-slide row">
                <?php endif; ?>    
                    <?php $n++; endwhile; ?>
                    </div><!--end news slide-->	
            	</div><!--end item-->
            </div><!--end carousel inner-->
        </div><!--end news slider-->
    <?php endif; wp_reset_postdata(); ?>
</div><!--end news-->