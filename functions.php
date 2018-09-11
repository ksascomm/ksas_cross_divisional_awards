<?php
function my_theme_enqueue_styles() {
	$parent_style = 'main-stylesheet';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/dist/assets/css/app.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function get_meta_values( $key = '', $type = 'profile', $status = 'publish' ) {
    global $wpdb;
    if( empty( $key ) )
        return;
    $r = $wpdb->get_col( $wpdb->prepare( "
        SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
        ORDER BY pm.meta_value DESC
    ", $key, $status, $type ) );
    return $r;
}

// Academic Department taxonomy for research profiles/spotlight
    function register_academicdepartment_tax() {
        $labels = array(
            'name'                  => _x( 'Departments', 'taxonomy general name' ),
            'singular_name'         => _x( 'Department', 'taxonomy singular name' ),
            'add_new'               => _x( 'Add New Department', 'Department'),
            'add_new_item'          => __( 'Add New Department' ),
            'edit_item'             => __( 'Edit Department' ),
            'new_item'              => __( 'New Department' ),
            'view_item'             => __( 'View Department' ),
            'search_items'          => __( 'Search Departments' ),
            'not_found'             => __( 'No Department found' ),
            'not_found_in_trash'    => __( 'No Department found in Trash' ),
        );
        
        $pages = array('courses','people','profile','post', 'studyfields', 'deptextra');
                    
        $args = array(
            'labels'            => $labels,
            'singular_label'    => __('Department'),
            'public'            => true,
            'show_ui'           => true,
            'hierarchical'      => true,
            'show_tagcloud'     => false,
            'show_in_nav_menus' => false,
            'rewrite'           => array('slug' => 'department', 'with_front' => false ),
         );
        register_taxonomy('academicdepartment', $pages, $args);
    }
    add_action('init', 'register_academicdepartment_tax');

// 2.2 Prepopulate choices for Academic Department taxonomy
function add_academicdepartment_terms() {
    wp_insert_term('Advanced Academic Programs', 'academicdepartment',  array('description'=> '','slug' => 'aap'));
    wp_insert_term('Anthropology', 'academicdepartment',  array('description'=> '','slug' => 'anthropology'));
    wp_insert_term('Biology', 'academicdepartment',  array('description'=> '','slug' => 'bio'));
    wp_insert_term('Biophysics', 'academicdepartment',  array('description'=> '','slug' => 'biophysics'));
    wp_insert_term('Chemistry', 'academicdepartment',  array('description'=> '','slug' => 'chemistry'));
    wp_insert_term('Classics', 'academicdepartment',  array('description'=> '','slug' => 'classics'));
    wp_insert_term('Cognitive Science', 'academicdepartment',  array('description'=> '','slug' => 'cogsci'));
    wp_insert_term('Earth and Planetary Sciences', 'academicdepartment',  array('description'=> '','slug' => 'eps'));
    wp_insert_term('Economics', 'academicdepartment',  array('description'=> '','slug' => 'econ'));
    wp_insert_term('English', 'academicdepartment',  array('description'=> '','slug' => 'english'));
    wp_insert_term('German and Romance Languages', 'academicdepartment',  array('description'=> '','slug' => 'grll'));
    wp_insert_term('History', 'academicdepartment',  array('description'=> '','slug' => 'history'));
    wp_insert_term('History of Art', 'academicdepartment',  array('description'=> '','slug' => 'arthist'));
    wp_insert_term('History of Science and Technology', 'academicdepartment',  array('description'=> '','slug' => 'host'));
    wp_insert_term('Humanities', 'academicdepartment',  array('description'=> '','slug' => 'humanities'));
    wp_insert_term('Mathematics', 'academicdepartment',  array('description'=> '','slug' => 'math'));
    wp_insert_term('Near Eastern Studies', 'academicdepartment',  array('description'=> '','slug' => 'neareast'));
    wp_insert_term('Philosophy', 'academicdepartment',  array('description'=> '','slug' => 'philosophy'));
    wp_insert_term('Physics and Astronomy', 'academicdepartment',  array('description'=> '','slug' => 'physics'));
    wp_insert_term('Political Science', 'academicdepartment',  array('description'=> '','slug' => 'polisci'));
    wp_insert_term('Psychological and Brain Sciences', 'academicdepartment',  array('description'=> '','slug' => 'pbs'));
    wp_insert_term('Sociology', 'academicdepartment',  array('description'=> '','slug' => 'soc'));
    wp_insert_term('Writing Seminars', 'academicdepartment',  array('description'=> '','slug' => 'writing'));
    wp_insert_term('Whiting School of Engineering', 'academicdepartment',  array('description'=> '','slug' => 'wse'));
}
add_action('init', 'add_academicdepartment_terms');


// Affiliation taxonomy for research profiles/spotlights
function register_affiliation_tax() {
    $labels = array(
        'name'                  => _x( 'Affiliations', 'taxonomy general name' ),
        'singular_name'         => _x( 'Affiliation', 'taxonomy singular name' ),
        'add_new'               => _x( 'Add New Affiliation', 'Affiliation'),
        'add_new_item'          => __( 'Add New Affiliation' ),
        'edit_item'             => __( 'Edit Affiliation' ),
        'new_item'              => __( 'New Affiliation' ),
        'view_item'             => __( 'View Affiliation' ),
        'search_items'          => __( 'Search Affiliations' ),
        'not_found'             => __( 'No Affiliation found' ),
        'not_found_in_trash'    => __( 'No Affiliation found in Trash' ),
    );
    
    $pages = array('post', 'profile');
                
    $args = array(
        'labels'            => $labels,
        'singular_label'    => __('Affiliation'),
        'public'            => true,
        'show_ui'           => true,
        'hierarchical'      => true,
        'show_tagcloud'     => false,
        'show_in_nav_menus' => false,
        'rewrite'           => array('slug' => 'affiliation', 'with_front' => false ),
     );
    register_taxonomy('affiliation', $pages, $args);
}
add_action('init', 'register_affiliation_tax');
   
// Prepopulate choices for affiliation taxonomy
function check_affiliation_terms() {
 
        // see if we already have populated any terms
    $term = get_terms( 'affiliation', array( 'hide_empty' => false ) );
 
    // if no terms then lets add our terms
    if( empty( $term ) ){
        $terms = define_affiliation_terms();
        foreach( $terms as $term ){
            if( !term_exists( $term['name'], 'affiliation' ) ){
                wp_insert_term( $term['name'], 'affiliation', array( 'slug' => $term['slug'] ) );
            }
        }
    }
}

add_action( 'init', 'check_affiliation_terms' );

function define_affiliation_terms() {
 
$terms = array(
    '0' => array( 'name' => 'Advanced Media Studies','slug' => 'cams'),
    '1' => array( 'name' => 'Africana Studies','slug' => 'africana'),
    '2' => array( 'name' => 'Archaeology','slug' => 'archaeology'), 
    '3' => array( 'name' => 'Behavioral Biology','slug' => 'behavbio'),
    '4' => array( 'name' => 'China STEM','slug' => 'chinastem'),
    '5' => array( 'name' => 'Dance','slug' => 'dance'),
    '6' => array( 'name' => 'Engineering','slug' => 'engineering'),
    '7' => array( 'name' => 'East Asian','slug' => 'eastasian'),
    '8' => array( 'name' => 'Embryology','slug' => 'embryo'),
    '9' => array( 'name' => 'Expository Writing','slug' => 'ewp'),
    '10' => array( 'name' => 'Film and Media','slug' => 'film'),
    '11' => array( 'name' => 'Financial Economics','slug' => 'cfe'),
    '12' => array( 'name' => 'Global Studies','slug' => 'arrighi'),
    '13' => array( 'name' => 'International Studies','slug' => 'international'),
    '14' => array( 'name' => 'Jewish Studies','slug' => 'jewish'),
    '15' => array( 'name' => 'Language Education','slug' => 'cledu'),
    '16' => array( 'name' => 'Latin American Studies','slug' => 'plas'),
    '17' => array( 'name' => 'Mind Brain Institute','slug' => 'mindbrain'),
    '18' => array( 'name' => 'Modern German Thought','slug' => 'maxkade'),
    '19' => array( 'name' => 'Museums and Society','slug' => 'museums'),
    '20' => array( 'name' => 'Music','slug' => 'music'),
    '21' => array( 'name' => 'Neuroscience','slug' => 'neuroscience'),
    '22' => array( 'name' => 'Post-Bac Pre-Med','slug' => 'pbpm'),
    '23' => array( 'name' => 'Pre-Law','slug' => 'prelaw'),
    '24' => array( 'name' => 'Pre-Med','slug' => 'premed'),
    '25' => array( 'name' => 'Premodern Europe','slug' => 'singleton'),
    '26' => array( 'name' => 'Public Health','slug' => 'publichealth'),
    '27' => array( 'name' => 'Quantum Matter','slug' => 'quantum'),
    '28' => array( 'name' => 'Social Policy','slug' => 'socialpolicy'),
    '29' => array( 'name' => 'Theatre Arts','slug' => 'theatre'),
    '30' => array( 'name' => 'Visual Arts','slug' => 'visual'),
    '31' => array( 'name' => 'Women Gender and Sexuality','slug' => 'wgs'),
    '32' => array( 'name' => 'Writing Center','slug' => 'writingcenter'),
    );
 
    return $terms;
}