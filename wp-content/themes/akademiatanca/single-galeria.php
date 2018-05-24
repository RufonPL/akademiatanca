<?php
/**
 * The Template for displaying all single gallery posts.
 *
 * @author Rafał Puczel
 */
get_header(); ?>

<?php 
$desc  			= get_field('_gallery_description'); 
$gallery_type	= get_field('_gallery_type');
$gallery 		= get_field('_gallery');
$gallery_video	= get_field('_gallery_video');
?>
<div class="container page-content">
    <div class="row gallery-single">
        <div id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
        	<?php section_header('<p><strong>'.get_the_title().'</strong></p><p>'.$desc.'</p>'); ?>
            <?php if($gallery_type == 'images' && $gallery) : ?>
            <div class="gallery-images row">
            	<?php foreach($gallery as $image) : ?>
                <div class="gallery-image col-md-3 col-sm-6 col-xs-12">
                	<div class="gallery-image-inner">
                    	<a class="relative" data-imagelightbox="lightbox" href="<?php echo esc_url($image['url']); ?>">
                            <img src="<?php echo esc_url($image['sizes']['gallery-image']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" data-description="<?php echo esc_attr($image['description']); ?>"/>
                            <div class="gallery-image-mask"></div>
                        </a>
                    </div><!--end gallery image inner-->
                </div><!--end gallery image-->
                <?php endforeach; ?>
            </div><!--end gallery images-->
            <?php endif; ?>
            
            <?php if($gallery_type == 'video' && $gallery_video) : ?>
            <div class="gallery-videos row">
            	<?php foreach($gallery_video as $videos) : ?>
                	<?php  
					$title = $videos['_video_title'];
					$code = $videos['_video_code'];
					?>
                    <?php if($code) : ?>
                    <div class="video-item text-center">
                    	<div class="video-box relative">
                            <a href="https://www.youtube.com/embed/<?php echo esc_html($code); ?>?rel=0&amp;color=white&amp;vq=highres&amp;theme=light&amp;showinfo=0" class="video-play"></a>
                            <iframe width="700" height="394" src="https://www.youtube.com/embed/<?php echo esc_html($code); ?>?rel=0&amp;color=white&amp;vq=highres&amp;theme=light&amp;showinfo=0" allowfullscreen></iframe>
                        	<?php if($title) : ?><h3><strong><?php echo esc_html($title); ?></strong></h3><?php endif; ?>    
                        </div><!--end video box-->
                    </div><!--end video item-->
                    <?php endif; ?>
                <?php endforeach; ?>
            </div><!--end gallery videos-->
            <?php endif; ?>
        </div><!--end post-->
    </div><!--end row-->
</div><!--end container-->

<?php get_footer(); ?>


