<?php if(is_front_page()) : ?>
	<?php $slider = get_field('_home_slider'); ?>
    <?php if($slider) : ?>
    <?php 
	$slide_speed 		= get_field('_home_slider_speed');
	$news_slide_speed 	= get_field('_news_slider_speed')
	?>
    <script>
    jQuery(document).ready(function($) {
        $('#slider').carousel({
            interval: <?php if($slide_speed) : echo wp_json_encode($slide_speed); else : echo '3000'; endif; ?>
        });  
		$('#news-slider').carousel({
            interval: <?php if($news_slide_speed) : echo wp_json_encode($news_slide_speed); else : echo '3000'; endif; ?>
        });
    });
    
    </script>
    <script>
    
    </script>
    <?php endif; ?>
    
<?php endif; ?>
<!-- Kod tagu remarketingowego Google -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 877963562;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/877963562/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>    
    

<script type="text/javascript">
var tag = document.createElement('script');
tag.src = "http://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function onYouTubeIframeAPIReady(event) {
  player = new YT.Player('youTubePlayer', {
    events: {
      'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange
    }
  });
}
var pauseFlag = false;
function onPlayerReady(event) {
   // do nothing, no tracking needed
}
function onPlayerStateChange(event) {
    // track when user clicks to Play
    if (event.data == YT.PlayerState.PLAYING) {
		switch(window.location.pathname) {
			case '/szkola-tanca-warszawa/':
				ga('send', 'event', 'Video', 'play', 'szkola-tanca-warszawa', 1);
				break;
			case '/imprezy/':
				ga('send', 'event', 'Video', 'play', 'imprezy', 1);
				break;
			default:
				break;
		}
        pauseFlag = true;
    }
    // track when user clicks to Pause
    if (event.data == YT.PlayerState.PAUSED && pauseFlag) {
        pauseFlag = false;
    }
    // track when video ends
    if (event.data == YT.PlayerState.ENDED) {
        
    }
}
</script>
