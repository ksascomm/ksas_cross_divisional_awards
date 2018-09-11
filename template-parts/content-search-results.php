<?php
/**
 * The default template for displaying indexed Profile content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<article <?php post_class(''); ?> aria-label="<?php the_title(); ?>: <?php echo strip_tags(get_post_meta($post->ID, 'ecpt_pull_quote', true)); ?>">
	<header class="article-header">	
		<h1 class="entry-title single-title search-result">
			<a href="<?php the_permalink() ?>">
				<?php if( 'profile' == get_post_type() ) :?> 
					Research Profile: <?php the_title(); ?> 
				<?php else : ?> 
					<?php the_title(); ?> 
				<?php endif;?>	
			</a>
		</h1>
	</header> <!-- end article header -->
					
	<div class="entry-content" itemprop="articleBody">
		<?php $content = get_the_content();
  		$trimmed_content = wp_trim_words( $content, 60, '[...]' ); ?>
  		<p><?php echo $trimmed_content; ?></p>
	</div> <!-- end article section -->
								    						
</article> <!-- end article -->
<hr>