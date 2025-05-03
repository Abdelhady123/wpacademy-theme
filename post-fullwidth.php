<?php
/**
 * Template Name: Full Width post
 * 
 * Template Post Type: post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wpAcademy
 */

get_header();
get_search_form();
?>
<style type="text/css">
  .site-main{
    width: 100%;
    grid-column-start: 1;
    grid-column-end: 4;
  }
  .search-form{
    margin: 1rem;
  }
  .post-widget{
    width: 100%;
    grid-column-start: 1;
    grid-column-end: 4;
    text-align: center;
  }
</style>

  <div class="content-area">
  <main id="primary" class="site-main">

<?php
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/content', get_post_type() );

	the_post_navigation(
		array(
			'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'wpacademy' ) . '</span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'wpacademy' ) . '</span> <span class="nav-title">%title</span>',
		)
	);

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
?>

</main><!-- #main -->
<div class="post-widget">
<?php
the_widget('WP_Widget_Meta');
?>
</div>


  </div>
	

<?php
get_footer();
