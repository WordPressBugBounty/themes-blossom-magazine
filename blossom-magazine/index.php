<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blossom_Magazine
 */
$blog_text     = get_theme_mod( 'blog_text', __( 'Latest Articles', 'blossom-magazine' ) );

get_header(); 

	/**
	 * HOMEPAGE SECTIONS
	 */
	if ( is_front_page() && is_home() ){
		$home_sections = array( 'cta', 'popular-cat' );

		if( $home_sections ){
			echo '<div class="homepage-sections">';
			foreach( $home_sections as $section ){
				get_template_part( 'sections/' . $section );  
			}
			echo '</div>';
		}
	}
	
	if ( is_front_page() ) echo '<div id="content" class="site-content"><div class="container">';
		/**
		 * Before Posts hook
		 * @hooked blossom_magazine_page_header - 10
		*/
		do_action( 'blossom_magazine_before_posts_content' ); ?>
		
		<div class="page-grid">
			<div id="primary" class="content-area">
				
				<?php if( $blog_text ) { ?>
					<header class="section-header">
						<h2 class="section-title blog-title"><?php echo esc_html( $blog_text); ?></h2>
					</header>
				<?php } ?>

				<main id="main" class="site-main">

				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

				</main><!-- #main -->
				
				<?php
				/**
				 * After Posts hook
				 * @hooked blossom_magazine_navigation - 15
				*/
				do_action( 'blossom_magazine_after_posts_content' );
				?>
				
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div>
	<?php if ( is_front_page() ) echo '</div></div>'; 

get_footer();