<?php
/**
 * The template for displaying a book
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

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
							<div class="entry-meta">
								<p class="entry-info">By <?php the_terms( $post->ID, 'book-author', '', '', '' ); ?>, added on <?php andrewspittle_posted_on(); ?></p>
							</div><!-- .entry-meta -->
						</header><!-- .entry-header -->
					
						<div class="entry-content">
							<?php if ( post_password_required() ) : ?>
								<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'andrewspittle' ) ); ?>
					
							<?php elseif ( is_single() ) : ?>
								<?php 
									if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
									  the_post_thumbnail( 'book-cover' ); // use the custom image size we've set in functions.php
									}
								?>
								<?php the_content(); ?>
							<?php elseif ( ! has_post_thumbnail() && ! is_single() ) : {
								// Props Otto http://ottopress.com/2011/photo-gallery-primer/
								$attachments = get_children( array(
									'post_parent' => get_the_ID(),
									'post_status' => 'inherit',
									'post_type' => 'attachment',
									'post_mime_type' => 'image',
									'order' => 'ASC',
									'orderby' => 'menu_order ID',
									'numberposts' => 1)
								);
								foreach ( $attachments as $thumb_id => $attachment )
									echo wp_get_attachment_image( $thumb_id, 'featured-thumbnail' ); // whatever size you want
								}
								the_excerpt();
							?>
								
							<?php else : ?>
								<?php the_excerpt(); ?>
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