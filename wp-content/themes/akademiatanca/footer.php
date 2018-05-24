<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @author Rafał Puczel
 */
?>

</div>	
    
<footer>
<div class="container-fluid footer">
	<?php require_template_part('newsletter', 'footer'); ?>
	<div class="container-wide" id="contact">
        <div class="container">
            <?php require_template_part('contact', 'footer'); ?>
            <?php require_template_part('copyrights', 'footer'); ?>
        </div><!--end container-->
    </div><!--end container wide-->
</div><!--end footer-->
</footer>

<?php require_template_part('login-register', 'user') ?> 
<?php require_template_part('signup-popup', '') ?>
<?php require_template_part('newsletter-popup', '') ?>

<?php wp_footer(); ?> 
<?php enqueue_footer_css(); ?>
<?php require_template_part('footer-js', 'footer') ?>
</body>
</html>