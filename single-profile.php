<?php
/**
 * The template for displaying all single Spotlight Profiles
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header();

?>
<div class="main-container" id="page">
	<div class="main-grid">
		<main class="main-content">
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
			<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
									
				<header class="article-header">	
					<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
			    </header> <!-- end article header -->
								
			    <section class="entry-content" itemprop="articleBody">
					<p class="no-margin">
					    <?php if ( get_post_meta($post->ID, 'ecpt_class_year', true) ) : ?>
					    	<strong>Year:</strong> <?php echo get_post_meta($post->ID, 'ecpt_class_year', true);?> <br>
					    <?php endif;?>
					
					<?php if (has_term('','academicdepartment', $post->ID) == true || has_term('','affiliation', $post->ID) == true) { ?>
						<strong>Affiliations:</strong>
					<?php } ?>
					<?php //Get the Academic Department Names
					$terms = get_the_terms($post->ID, 'academicdepartment');
					if ($terms && !is_wp_error($terms)):
					    $dept_name_array = array();
					    foreach ($terms as $term) {
					        $dept_name_array[] = $term->name;
					    }
					    $dept_name = join(", ", $dept_name_array);
					    echo $dept_name;
					endif;
					//Get the Affiliation Names
					$terms_2 = get_the_terms($post->ID, 'affiliation');
					if ($terms_2 && !is_wp_error($terms_2)):
					    $affil_name_array = array();
					    foreach ($terms_2 as $term_2) {
					        $affil_name_array[] = $term_2->name;
					    }
					    $affil_name = join(", ", $affil_name_array);
					    if (has_term('', 'academicdepartment', $post->ID) == true) {
					        echo ',';
					    }
					    echo ' ' . $affil_name;
					?>
					
					<?php endif;?>							
						<br><strong>Award:</strong> <?php $categories = get_the_category(); 
							if ( ! empty( $categories ) ) {
							    echo esc_html( $categories[0]->name );   
							} ?>
					</p>

					<?php if ( get_post_meta($post->ID, 'ecpt_award_name', true) ) : ?>
					    
					    <h5 class="black"><?php echo get_post_meta($post->ID, 'ecpt_award_name', true); ?></h5>
					
					<?php endif; ?>	

					<?php if ( has_post_thumbnail() ) { the_post_thumbnail('slider', array('class' => 'floatleft')); } ?>
						
					<h3>Project Description</h3>
					
					<?php the_content(); ?>						
					
					<?php if ( get_post_meta($post->ID, 'ecpt_article_list', true) ) : ?>
					
						<h5>Articles and Related Links</h5>
					
						<?php echo get_post_meta($post->ID, 'ecpt_article_list', true); ?>
					
					<?php endif; ?>						
					

					<?php if ( get_post_meta($post->ID, 'ecpt_video', true) || get_post_meta($post->ID, 'ecpt_research_pdf', true)) : ?>
			
						<h5>Multimedia</h5>
						
						<?php if ( get_post_meta($post->ID, 'ecpt_research_pdf', true) ) : ?>
							<p>
								<a href="<?php echo get_post_meta($post->ID, 'ecpt_research_pdf', true); ?>">Download research materials</a>
							</p>
						<?php endif; ?>
						<?php if ( get_post_meta($post->ID, 'ecpt_video', true) ) : ?>
							<p>
								<a href="<?php echo get_post_meta($post->ID, 'ecpt_video', true); ?>">Watch research video</a>
							</p>
						<?php endif; ?>

					<?php endif; ?>

				</section> <!-- end article section -->
																
			</article> <!-- end article -->
	   	
	    <?php endwhile; endif; ?>
		</main>
		<?php do_action('foundationpress_after_content'); ?>
    	<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();