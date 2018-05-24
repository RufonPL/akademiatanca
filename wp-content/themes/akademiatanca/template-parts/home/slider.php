<?php $slider = get_field('_home_slider'); ?>

<?php if($slider) : ?>
<?php $slides = count($slider); ?> 
    <div id="slider" class="carousel slide">
    	<ol class="carousel-indicators">
            <?php $i=0; foreach($slider as $slide) : ?>
                <li data-target="#slider" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0): ?>active<?php endif; ?>">      
            <?php $i++; endforeach; ?>
        </ol><!--end carousel indicators-->
    
        <div class="carousel-inner">
        <?php $i=0; foreach($slider as $slide) : ?> 
        <?php 
		$image 		= $slide['_slide_img'];
		$header 	= $slide['_slide_header'];
		$text 		= $slide['_slide_text']; 
		$link_type 	= $slide['_slide_link'];
		$link 		= $link_type == 'inner' ? get_permalink($slide['_slide_link_inner']) : $slide['_slide_link_outer']; 
		?>
        	<div class="item<?php if($i==0): ?> active<?php endif; ?>">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <div class="carousel-caption container text-center">
                <?php if($header) : ?><h2 class="h1 text-uppercase"><?php echo p2br(strip_tags($header, '<p><strong>')); ?></h2><?php endif; ?>	
                <?php if($text) : ?><p><?php echo esc_html($text); ?></p><?php endif; ?>
                <?php if($link) : ?>
                	<a href="<?php echo esc_url($link); ?>" class="btn  text-uppercase"><div style="background:url('https://www.akademiatanca.com.pl/wp-content/themes/akademiatanca/images/czytaj-slider.png') no-repeat; width:201px; height:52px;"></div> </a>
                <?php endif; ?>
                </div><!--end carousel caption-->
            </div><!--end item-->
        <?php $i++; endforeach; ?>
        </div><!--end carousel inner-->
        
        <?php if($slides>1) : ?> 
        <a class="left carousel-control" href="#slider" data-slide="prev">
        	<i class="fa fa-chevron-left"></i>
        </a>
        <a class="right carousel-control" href="#slider" data-slide="next">
        	<i class="fa fa-chevron-right"></i>
        </a>
        <?php endif; ?><!--end count rows-->
     
    </div><!--end carousel-->
<?php endif; ?><!--end _slider-->
