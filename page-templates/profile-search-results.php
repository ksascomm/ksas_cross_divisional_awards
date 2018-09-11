<?php
/*
Template Name: Research Profile Search Results
*/
?>
<?php get_header(); 
global $post; // Setup the global variable $post
$parent_title = get_the_title( $post->post_parent );
$ancestor_url = get_permalink($post->post_parent); ?>

<div class="main-container" id="page">
    <div class="main-grid">
        <main class="main-content">
				<?php if(empty($_POST['keyword']) == false) {
					$keyword = $_POST['keyword'];
					$keyword_query = array('s' => $keyword); }
				else {
					$keyword_query = array();
				}
				
				if(empty($_POST['affiliation']) == false) {
					$affiliation = $_POST['affiliation'];
					$affiliation_query = array(
					'tax_query' => array(
								'relation' => 'OR',
								array(
								'taxonomy' => 'academicdepartment',
								'field' => 'slug',
								'terms' => $affiliation,
								),
								array(
								'taxonomy' => 'affiliation',
								'field' => 'slug',
								'terms' => $affiliation
								))
					);
					}
				else {
					$affiliation_query = array();
				}
				
				if(empty($_POST['award']) == false) {
					$year = $_POST['award'];
					$year_query = array(
						'meta_query' => array(
								array(
									'key' => 'ecpt_class_year',
									'value' => $year,
								))); }
				else {
					$year_query = array();
				}
				
				$standard_args = array(
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

							);
				$query_args = array_merge($standard_args, $affiliation_query, $year_query, $keyword_query); 

				$research_search_results_query = new WP_Query($query_args);  	?>
					
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
				<h1><?php the_title();?></h1>
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

				<?php the_content(); ?>
			<?php endwhile; endif; ?>

			<?php if ($research_search_results_query->have_posts()) : while ($research_search_results_query->have_posts()) : $research_search_results_query->the_post(); ?>
				<ul id="directory">
					<?php get_template_part( 'template-parts/content', 'indexed-profile' ); ?>
				</ul>
				<?php endwhile; ?>
			<?php else :?>
				<h2> No Results</h2>
			<?php endif;?>
				
			</main> <!-- end #main -->
			
		    <?php get_sidebar(); ?>
		
		</div> <!-- end #inner-content -->
	
	</div> <!-- end #content -->

<?php get_footer(); ?> 