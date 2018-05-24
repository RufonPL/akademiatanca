<?php
/**
 * Template name: Cennik
 * The template for displaying prices page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @author Rafał Puczel
 */

get_header(); ?>

<?php  
$price_lists = get_field('_price_lists');
$text_before = get_field('_price_lists_text_before');
$text_after = get_field('_price_lists_text_after');
?>

<div class="container page-content">
	<?php section_header(get_field('_page_header'), $post->ID); ?>
    <div class="row">
    	<?php if($text_before) : ?>
        <div class="prices-text-before">
        	<?php echo $text_before; ?>
        </div><!--end prices text before-->
        <?php endif; ?>
        <?php if($price_lists) : ?>
        <div class="prices-table prices-container">
            <?php foreach($price_lists as $list) : ?>
				<?php  
                $pl_name 				= $list['_pl_name'];
                $pl_pass_info 			= $list['_plg_pass_info'];
                $pl_full_payment_info 	= $list['_plg_full_payment_info'];
                $pl_group 				= $list['_pl_group'];	
                ?>
                <?php if($pl_name) : ?>
                <h5 class="st-header text-center"><strong><?php echo esc_html($pl_name); ?></strong></h5>
                <?php endif; ?>
                <?php if($pl_group) : ?>
                	<?php foreach($pl_group as $group) : ?>
                    	<?php  
						$plg_name = $group['_plg_name'];
						$plg_type = $group['_plg_type'];
						?>
                        <?php if($plg_name) : ?>
                        <h6 class="st-level text-center"><strong><?php echo esc_html($plg_name); ?></strong></h6>
                        <?php endif; ?>
                        <?php if($plg_type) : ?>
                        	<?php foreach($plg_type as $type) : ?>
                            	<?php  
								$plgt_table_name 	= $type['_plgt_table_name'];
								$plgt_table 		= $type['_plgt_table'];
								?>
                                <?php if($plgt_table_name) : ?>
                                <h6 class="st-level plgt-table-name text-center"><strong><?php echo esc_html($plgt_table_name); ?></strong></h6>
                                <?php endif; ?>
                                <?php if($plgt_table) : ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Ilość zajęć</th>
                                                <th>1 zajęcia</th>
                                                <th><?php echo esc_html($pl_pass_info); ?></th>
                                                <th><?php echo esc_html($pl_full_payment_info); ?></th>
                                                <th>Oferta specjalna</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                	<?php foreach($plgt_table as $table) : ?>
                                    	<?php  
										$plgt_name 			= $table['_plgt_name'];
										$plgt_lessons_no 	= $table['_plgt_lessons_no'];
										$plgt_first_lesson 	= $table['_plgt_first_lesson'];
										$plgt_pass 			= $table['_plgt_pass'];
										$plgt_full_payment 	= $table['_plgt_full_payment'];
										$plgt_special_offer = $table['_plgt_special_offer'];
										?>
                                        <tr>
                                        	<td class="plgt-name"><?php echo esc_html($plgt_name); ?></td>
                                        	<td class="plgt-lessons"><?php echo esc_html($plgt_lessons_no); ?></td>
                                        	<td class="plgt-lesson"><?php echo esc_html($plgt_first_lesson); ?></td>
                                        	<td class="plgt-pass"><?php echo esc_html($plgt_pass); ?></td>
                                        	<td class="plgt-full"><?php echo esc_html($plgt_full_payment); ?></td>
                                        	<td class="plgt-special"><?php echo esc_html($plgt_special_offer); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    	</tbody>
                                    </table>
                                </div><!--end table responsive-->
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div><!--signup table-->
        <?php endif; ?>
    	<?php if($text_after) : ?>
        <div class="prices-text-after">
        	<?php echo $text_after; ?>
        </div><!--end prices text after-->
        <?php endif; ?>
    </div><!--end row-->
</div><!--end container-->               

<?php 
$show_map = get_field('_show_places_map');
$courses_map_header = get_field('_cp_map_header', 'option'); 
?>
<?php if($show_map == 'Tak') : ?>
<div class="container-fluid courses-map relative">
	<div class="container">
    <?php if($courses_map_header) : ?><h5><strong><?php echo esc_html($courses_map_header); ?></strong></h5><?php endif; ?>
    </div><!--end container-->
    <?php require_template_part('google-map', '') ?>
</div><!--end container fluid-->
<?php endif; ?>           

<?php get_footer(); ?>
