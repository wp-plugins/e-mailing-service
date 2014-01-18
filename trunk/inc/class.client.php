<?php
class myTinyMceButton_Client {
	function __construct() {
		add_shortcode( 'my-listing' , array( &$this, 'shortcode' ) );
	}

	function shortcode( $atts ) {
		extract( shortcode_atts( array(
		'category' => 0,
		'posts_per_page' =>5,
		), $atts ) );
		
		if ( empty( $category ) )
			return false;
		
		ob_start();
		
		$q_posts = new WP_Query( array( 'post_type' => 'post', 'category__in' => $category, 'posts_per_page' => (int)$posts_per_page ) );
		
		if(  $q_posts->have_posts() ) {
		?>
		<ul>
		<?php
		while( $q_posts->have_posts() ) {
			$q_posts->the_post();
			
				?>
			
				<li>
					<a href='<?php the_permalink();?>'><?php the_title();?></a>
				</li>
				<?php
			
				}
				?>
			</ul>
			<?php
			wp_reset_post_data();
		}
		
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}
}
?>