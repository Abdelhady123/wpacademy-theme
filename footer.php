<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wpAcademy
 */

?>

	<footer id="colophon" class="site-footer">
		<?php 
		if(is_active_sidebar('footer-sidebar')){
			?>
		<div class="footer-sidebar">
			<?php dynamic_sidebar('footer-sidebar'); ?>
		</div>
		<?php } ?>
		<div class="site-info">
			<p> 
				<?php echo get_theme_mod('footer_text','Academy   ©| All Rights Reserved'); ?>;
			</p>
		</div><!-- .site-info -->
		<?php
		if(has_nav_menu('menu-2'))
			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'Social-menu',
					'container'  =>'nav',
					'container_class' => 'social',
					'link_before' =>'<span class="user_text">',
					'link_after'  => '</span>'
				)
			);
			?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
