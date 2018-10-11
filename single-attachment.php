<?php
/**
 * The template for displaying all single attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();

?>
<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content-full-width">
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
										
					<header class="article-header">	
						<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?>
						</h1>
				    </header> <!-- end article header -->
									
				    <div class="entry-content" itemprop="articleBody">
						<p>
							<a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment">
									<?php the_title(); ?>
							</a>
						</p>
						<h3>Description:</h3>
						<?php the_excerpt(); ?>
					</div> <!-- end article section -->
																	
				</article> <!-- end article -->

			<?php endif; endwhile; ?>
		</main>
	</div>
</div>
<?php get_footer();