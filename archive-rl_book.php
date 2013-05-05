<?php
/**
 * The template for displaying a list of books
 *
 * @package Andrew Spittle
 * @since Andrew Spittle 1.0
 */
 
get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'book-column' ); ?>>
						<?php 
							if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							  the_post_thumbnail( 'book-cover' ); // use the custom image size we've set in functions.php
							}
						?>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<div class="entry-meta">
								<p class="entry-author">By <?php the_terms( $post->ID, 'book-author', '', '', '' ); ?></p>
							</div><!-- .entry-meta -->
						</header><!-- .entry-header -->
					
						<div class="entry-content">
							<?php if ( !empty( $post->post_content) ) : ?>
								<p class="entry-notes"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'andrewspittle' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">View notes &rarr;</a></p>
							<?php endif; ?>
							<?php if ( post_password_required() ) : ?>
								<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'andrewspittle' ) ); ?>
							<?php endif; ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'andrewspittle' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content -->
						<?php //endif; ?>
					
						<footer class="entry-meta">
							<?php edit_post_link( __( 'Edit', 'andrewspittle' ), '<span class="edit-link">', '</span>' ); ?>
						</footer><!-- .entry-meta -->
					</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>