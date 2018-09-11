<?php
/*
Template Name: Research Profile Index
*/
?>
<?php get_header();
global $post; // Setup the global variable $post
$parent_title = get_the_title( $post->post_parent );
$ancestor_url = get_permalink($post->post_parent); 
		$research_profiles_index_query = new WP_Query(array(
			'post_type' => 'profile',
			'posts_per_page' => '-1',
			'post_status'=>'publish',
			'meta_key' => 'ecpt_award_alpha',
			'orderby' => 'meta_value',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $parent_title,
					'operator' => 'IN'
				)
			),

			)); 
	?>
<?php get_template_part( 'template-parts/featured-image' ); ?>
<div class="main-container" id="page">
    <div class="main-grid">
        <main class="main-content">
					
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
												
							<h1 class="page-title"><?php the_title(); ?></h1>
											
						    <div class="entry-content" itemprop="articleBody">

								<?php the_content(); ?>
								<div class="callout secondary profile-search">
									<form method="post" action="<?php echo $ancestor_url;?>results/">
										<div class="grid-x">
											<div class="large-4 cell option">
												<label for="affiliation" class="bold inline">Affiliation:
												<select id="affiliation" name="affiliation" class="inline">
													<option value="">Any Affiliation</option>
													<?php $terms = get_terms(array('taxonomy' => array('academicdepartment', 'affiliation'), 'hide_empty' => false,));
													foreach ($terms as $term) {
													    echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
													} ?>
												</select>
												</label>
											</div>
											<div class="large-3 cell option">
												<label for="award" class="screen-reader-text">Select Year</label>
												<label for="award" class="bold inline">Select Year
												<select id="award" name="award">
													<option value="">Any Year</option>
													<?php $award_years = get_meta_values('ecpt_class_year');
													echo $award_years;
														foreach ($award_years as $award_year) {
															echo '<option value"' . $award_year . '">' . $award_year . '</option>';
													} ?>
												</select>
												</label>
											</div>
											<div class="large-3 cell option">
												<input type="submit" class="button search" value="Search" />
											</div>
										</div>
									</form>
								</div>
								
							</div> <!-- end article section -->
												
						</article> <!-- end article -->						
						
					<?php endwhile; endif; ?>	
					<ul id="directory">
						<?php while ($research_profiles_index_query->have_posts()) : $research_profiles_index_query->the_post(); ?>
							<?php get_template_part( 'template-parts/content', 'indexed-profile' ); ?>
						<?php endwhile; ?>
					</ul>					
				
			</main> <!-- end #main -->
		    
			<?php get_sidebar(); ?>
		
		</div>
	
	</div>

<?php get_footer(); ?>