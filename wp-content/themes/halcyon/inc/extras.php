<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Halcyon
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function halcyon_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}
    
	if( ! is_active_sidebar( 'right-sidebar' ) ) {
		$classes[] = 'full-width';	
	}
    
    if( is_page() ){
        $sidebar_layout = halcyon_sidebar_layout();
        if( $sidebar_layout == 'no-sidebar' )
		$classes[] = 'full-width';
    }
    
    return $classes;
}
add_filter( 'body_class', 'halcyon_body_classes' );

/**
* Adds custom classes to the array of post classes.
*
* @param array $classes Classes for the post element.
* @return array
*/
function halcyon_post_classes( $classes ) {
    global $post;
    if( ! has_post_thumbnail( $post->ID ) ){
        $classes[] = 'no-featured-image';
    }
    return $classes;
}
add_filter( 'post_class', 'halcyon_post_classes' );

/**
 * Callback for Social Links 
 */
function halcyon_social_cb(){
    $facebook    = get_theme_mod( 'halcyon_facebook' );
    $twitter     = get_theme_mod( 'halcyon_twitter' );
    $pinterest   = get_theme_mod( 'halcyon_pinterest' );
    $instagram   = get_theme_mod( 'halcyon_instagram' );
    $rss         = get_theme_mod( 'halcyon_rss' );
    $dribble     = get_theme_mod( 'halcyon_dribble' );
    $linkedin    = get_theme_mod( 'halcyon_linkedin' );
    $google_plus = get_theme_mod( 'halcyon_google_plus' );
    
    if( $facebook || $twitter || $instagram || $google_plus || $pinterest || $linkedin || $rss || $dribble ){
    ?>
    <ul class="social-networks">
		<?php if( $facebook ){ ?>
            <li><a href="<?php echo esc_url( $facebook );?>" target="_blank" title="<?php esc_attr_e( 'Facebook', 'halcyon' ); ?>"><i class="fa fa-facebook"></i></a></li>
		<?php } if( $twitter ){ ?>    
            <li><a href="<?php echo esc_url( $twitter );?>" target="_blank" title="<?php esc_attr_e( 'Twitter', 'halcyon' ); ?>"><i class="fa fa-twitter"></i></a></li>
        <?php } if( $pinterest ){ ?>
            <li><a href="<?php echo esc_url( $pinterest );?>" target="_blank" title="<?php esc_attr_e( 'Pinterest', 'halcyon' ); ?>"><i class="fa fa-pinterest-p"></i></a></li>
        <?php } if( $instagram ){ ?>
            <li><a href="<?php echo esc_url( $instagram );?>" target="_blank" title="<?php esc_attr_e( 'Instagram', 'halcyon' ); ?>"><i class="fa fa-instagram"></i></a></li>
        <?php } if( $rss ){ ?>
            <li><a href="<?php echo esc_url( $rss );?>" target="_blank" title="<?php esc_attr_e( 'RSS', 'halcyon' ); ?>"><i class="fa fa-rss"></i></a></li>
		<?php } if( $dribble ){ ?>
            <li><a href="<?php echo esc_url( $dribble );?>" target="_blank" title="<?php esc_attr_e( 'Dribble', 'halcyon' ); ?>"><i class="fa fa-dribbble"></i></a></li>		
		<?php } if( $linkedin ){ ?>
            <li><a href="<?php echo esc_url( $linkedin );?>" target="_blank" title="<?php esc_attr_e( 'LinkedIn', 'halcyon' ); ?>"><i class="fa fa-linkedin"></i></a></li>
        <?php } if( $google_plus ){ ?>
            <li><a href="<?php echo esc_url( $google_plus );?>" target="_blank" title="<?php esc_attr_e( 'Google Plus', 'halcyon' ); ?>"><i class="fa fa-google-plus"></i></a></li>
        <?php } ?>
	</ul>
    <?php
    }
}
add_action( 'halcyon_social', 'halcyon_social_cb' );

if( ! function_exists( 'halcyon_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function halcyon_change_comment_form_default_fields( $fields ){    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $required = ( $req ? " required" : '' );
    $author   = ( $req ? __( 'Name*', 'halcyon' ) : __( 'Name', 'halcyon' ) );
    $email    = ( $req ? __( 'Email*', 'halcyon' ) : __( 'Email', 'halcyon' ) );
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label class="screen-reader-text" for="author">' . esc_html__( 'Name', 'halcyon' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr( $author ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $required . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label class="screen-reader-text" for="email">' . esc_html__( 'Email', 'halcyon' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr( $email ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $required. ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label class="screen-reader-text" for="url">' . esc_html__( 'Website', 'halcyon' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'halcyon' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;    
}
endif;
add_filter( 'comment_form_default_fields', 'halcyon_change_comment_form_default_fields' );

if( ! function_exists( 'halcyon_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function halcyon_change_comment_form_defaults( $defaults ){    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label class="screen-reader-text" for="comment">' . esc_html__( 'Comment', 'halcyon' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'halcyon' ) . '" cols="45" rows="8" aria-required="true" required></textarea></p>';
    
    return $defaults;    
}
endif;
add_filter( 'comment_form_defaults', 'halcyon_change_comment_form_defaults' );

/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function halcyon_theme_comment( $comment, $args, $depth ){
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body" itemscope itemtype="https://schema.org/UserComments">
	<?php endif; ?>
	
    <footer class="comment-meta">
        <div class="comment-author vcard">
    	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
    	<?php printf( _x( '<b class="fn" itemprop="creator" itemscope itemtype="https://schema.org/Person">%s</b>', 'comment author link', 'halcyon' ), get_comment_author_link() ); ?>
    	</div>
    	<?php if ( $comment->comment_approved == '0' ) : ?>
    		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'halcyon' ); ?></em>
    		<br />
    	<?php endif; ?>
    
    	<div class="comment-metadata commentmetadata">
            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                <time><?php echo get_comment_date(); ?></time>
            </a>
    	</div>
    </footer>
    <div class="comment-content"><?php comment_text(); ?></div>
    
	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

/**
 * Slider Callback 
 */
function halcyon_slider_cb(){
    $ed_caption  = get_theme_mod( 'halcyon_slider_caption', '1' );
    $read_more   = get_theme_mod( 'halcyon_slider_read_more', __( 'Read Post', 'halcyon' ) );
    $sticky_post = get_option( 'sticky_posts' ); //get all sticky posts
    
    $qry = new WP_Query ( array( 
        'post_type'           => 'post', 
        'post_status'         => 'publish',
        'posts_per_page'      => -1,
        'post__in'            => $sticky_post,
        'ignore_sticky_posts' => 1 
    ) );
    
    if( $sticky_post && $qry->have_posts() ){ ?>
    
        <div class="slider">
			<ul id="lightSlider" class="owl-carousel">				
            <?php
            while( $qry->have_posts()){
                $qry->the_post();                 
                if( has_post_thumbnail() ){
                    $categories_lists = get_the_category();
                    if( $categories_lists && halcyon_categorized_blog() ){
                        $categories = '';
                        $i = 1;                        
                        foreach( $categories_lists as $cat ){
                            $categories .= $cat->name;
                            if( $i < count( $categories_lists ) ){
                                $categories .= __( ', ', 'halcyon' );
                            }
                            $i++;
                        }
                    }?>
                <li>
					<?php the_post_thumbnail( 'halcyon-slider', array( 'itemprop' => 'image' ) );?>
					<?php if( $ed_caption ){ ?>
                    <div class="banner-text">
						<div class="container">
							<div class="text">
								<span><?php echo esc_html( $categories ) . ' &sol; ' .  esc_html( get_the_date() ); ?></span>
								<h2><?php the_title(); ?></h2>
								<a href="<?php the_permalink(); ?>" class="read-more"><?php echo esc_html( $read_more ); ?></a>
							</div>
						</div>
					</div>
                    <?php }?>
				</li>                
            <?php 
                }
            }
            wp_reset_postdata();
            ?>
            </ul>
		</div> 
             
    <?php
    }        
}
add_action( 'halcyon_slider', 'halcyon_slider_cb' );

/**
 * Function to exclude sticky post from main query
*/
function halcyon_exclude_posts( $query ){
    
    $stickies = get_option( 'sticky_posts' ); //get all sticky posts
    $one      = get_theme_mod( 'halcyon_featured_post_one' );
    $two      = get_theme_mod( 'halcyon_featured_post_two' );
    $three    = get_theme_mod( 'halcyon_featured_post_three' );
    
    if( ( $one || $two || $three ) && get_theme_mod( 'halcyon_ed_featured_post' ) ){
        $posts = array( $one, $two, $three );
        $posts = array_map( 'intval', $posts );
        if( $stickies ) $posts = array_merge( $stickies, $posts );
        $excludes = array_diff( array_unique( $posts ), array('') );
    }elseif( $stickies && get_theme_mod( 'halcyon_ed_slider' ) ){
        $excludes = $stickies;
    }else{
        $excludes = array();
    }    

    if ( ! is_admin() && $query->is_home() && $query->is_main_query() && $excludes ) {
        $query->set( 'post__not_in', $excludes );
        $query->set( 'ignore_sticky_posts', true );
    }    
}
add_filter( 'pre_get_posts', 'halcyon_exclude_posts' );

/**
 * Callback function for Featured Post
*/
function halcyon_featured_post_cb(){
    
    $title      = get_theme_mod( 'halcyon_featured_section_title' );
    $post_one   = get_theme_mod( 'halcyon_featured_post_one' );
    $post_two   = get_theme_mod( 'halcyon_featured_post_two' );
    $post_three = get_theme_mod( 'halcyon_featured_post_three' );
    
    if( $post_one || $post_two || $post_three ){
        $featured_posts = array( $post_one, $post_two, $post_three );
        $featured_posts = array_diff( array_unique( $featured_posts ), array('') );
        
        $qry = new WP_Query( array( 
            'post_type'             => 'post',
            'posts_per_page'        => -1,
            'post__in'              => $featured_posts,
            'orderby'               => 'post__in',
            'ignore_sticky_posts'   => true
        ) );
        
        if( $qry->have_posts() ){
            ?>
            <div class="top-section">
        		<div class="container">
                    
                   <?php if( $title ) echo '<h2 class="section-title">' . esc_html( $title ) . '</h2>'; ?>
                    
                   <div class="row">
                    <?php
                    while( $qry->have_posts() ){
                        $qry->the_post();
                        $categories_lists = get_the_category();
                        ?>
                        <div class="column">
        					<article class="post">
                                <div class="image-holder">
        							<a href="<?php the_permalink(); ?>" class="post-thumbnail">
            						<?php 
                                    if( has_post_thumbnail() ){ 
                                        the_post_thumbnail( 'halcyon-featured-post', array( 'itemprop' => 'image' ) ); 
                                    }else{
                                        halcyon_get_fallback_svg( 'halcyon-featured-post' );
                                    } ?>
                                    </a>
        						</div>
        						<header class="entry-header">
        							<?php
                                    if( $categories_lists && halcyon_categorized_blog() ){
                                        $i = 1;
                                        echo '<span class="category">';
                                        foreach( $categories_lists as $category ){
                                            echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
                                            if( $i < count( $categories_lists ) ){
                                                _e( ', ', 'halcyon' );
                                            }
                                            $i++;
                                        }
                                        echo '</span>';
                                    } 
                                    ?>
        							<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        							<div class="entry-meta">
        								<span><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_date() ); ?></a></span>
        							</div>
        						</header>
        					</article>
        				</div>
                        <?php }?>
                    </div>
                </div>
            </div>
        <?php             
        }
        wp_reset_postdata();
    }
}
add_action( 'halcyon_featured_post', 'halcyon_featured_post_cb' );

/**
 * Custom CSS
*/
if ( function_exists( 'wp_update_custom_css_post' ) ) {
    // Migrate any existing theme CSS to the core option added in WordPress 4.7.
    $css = get_theme_mod( 'halcyon_custom_css' );
    if ( $css ) {
        $core_css = wp_get_custom_css(); // Preserve any CSS already added to the core option.
        $return = wp_update_custom_css_post( $core_css . $css );
        if ( ! is_wp_error( $return ) ) {
            // Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
            remove_theme_mod( 'halcyon_custom_css' );
        }
    }
} else {
    // Back-compat for WordPress < 4.7.
      function halcyon_custom_css(){
      $custom_css = get_theme_mod( 'halcyon_custom_css' );
      if( !empty( $custom_css ) ){
        echo '<style type="text/css">';
        echo wp_strip_all_tags( $custom_css );
        echo '</style>';
      }
    }
    add_action( 'wp_head', 'halcyon_custom_css', 100 );
}

if ( ! function_exists( 'halcyon_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function halcyon_excerpt_more( $more ) {
	return is_admin() ? $more : ' &hellip; ';
}
add_filter( 'excerpt_more', 'halcyon_excerpt_more' );
endif;

if ( ! function_exists( 'halcyon_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function halcyon_excerpt_length( $length ) {
	return is_admin() ? $length : 20;
}
add_filter( 'excerpt_length', 'halcyon_excerpt_length', 999 );
endif;

/**
 * Return sidebar layouts for pages
*/
function halcyon_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'halcyon_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'halcyon_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}

if( ! function_exists( 'halcyon_single_post_schema' ) ) :
/**
 * Single Post Schema
 *
 * @return string
 */
function halcyon_single_post_schema() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $custom_logo_id = get_theme_mod( 'custom_logo' );

        $site_logo   = wp_get_attachment_image_src( $custom_logo_id , 'halcyon-schema' );
        $images      = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $excerpt     = halcyon_escape_text_tags( $post->post_excerpt );
        $content     = $excerpt === "" ? mb_substr( halcyon_escape_text_tags( $post->post_content ), 0, 110 ) : $excerpt;
        $schema_type = ! empty( $custom_logo_id ) && has_post_thumbnail( $post->ID ) ? "BlogPosting" : "Blog";

        $args = array(
            "@context"  => "https://schema.org",
            "@type"     => $schema_type,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id"   => esc_url( get_permalink( $post->ID ) )
            ),
            "headline"      => esc_html( get_the_title( $post->ID ) ),
            "datePublished" => esc_html( get_the_time( DATE_ISO8601, $post->ID ) ),
            "dateModified"  => esc_html( get_post_modified_time(  DATE_ISO8601, __return_false(), $post->ID ) ),
            "author"        => array(
                "@type"     => "Person",
                "name"      => halcyon_escape_text_tags( get_the_author_meta( 'display_name', $post->post_author ) )
            ),
            "description" => ( class_exists('WPSEO_Meta') ? WPSEO_Meta::get_value( 'metadesc' ) : $content )
        );

        if ( has_post_thumbnail( $post->ID ) ) :
            $args['image'] = array(
                "@type"  => "ImageObject",
                "url"    => $images[0],
                "width"  => $images[1],
                "height" => $images[2]
            );
        endif;

        if ( ! empty( $custom_logo_id ) ) :
            $args['publisher'] = array(
                "@type"       => "Organization",
                "name"        => esc_html( get_bloginfo( 'name' ) ),
                "description" => wp_kses_post( get_bloginfo( 'description' ) ),
                "logo"        => array(
                    "@type"   => "ImageObject",
                    "url"     => $site_logo[0],
                    "width"   => $site_logo[1],
                    "height"  => $site_logo[2]
                )
            );
        endif;

        echo '<script type="application/ld+json">' , PHP_EOL;
        if ( version_compare( PHP_VERSION, '5.4.0' , '>=' ) ) {
            echo wp_json_encode( $args, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) , PHP_EOL;
        } else {
            echo wp_json_encode( $args ) , PHP_EOL;
        }
        echo '</script>' , PHP_EOL;
    }
}
endif;
add_action( 'wp_head', 'halcyon_single_post_schema' );

if( ! function_exists( 'halcyon_escape_text_tags' ) ) :
/**
 * Remove new line tags from string
 *
 * @param $text
 * @return string
 */
function halcyon_escape_text_tags( $text ) {
    return (string) str_replace( array( "\r", "\n" ), '', strip_tags( $text ) );
}
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if( ! function_exists( 'halcyon_admin_notice' ) ) :
/**
 * Addmin notice for getting started page
*/
function halcyon_admin_notice(){
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'halcyon_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();
    
    if( 'themes.php' == $pagenow && !$meta ){
        
        if( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ){
            return;
        }

        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } ?>

        <div class="welcome-message notice notice-info">
            <div class="notice-wrapper">
                <div class="notice-text">
                    <h3><?php esc_html_e( 'Congratulations!', 'halcyon' ); ?></h3>
                    <p><?php printf( __( '%1$s is now installed and ready to use. Click below to see theme documentation, plugins to install and other details to get started.', 'halcyon' ), esc_html( $name ) ) ; ?></p>
                    <p><a href="<?php echo esc_url( admin_url( 'themes.php?page=halcyon-getting-started' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to the getting started.', 'halcyon' ); ?></a></p>
                    <p class="dismiss-link"><strong><a href="?halcyon_admin_notice=1"><?php esc_html_e( 'Dismiss', 'halcyon' ); ?></a></strong></p>
                </div>
            </div>
        </div>
    <?php }
}
endif;
add_action( 'admin_notices', 'halcyon_admin_notice' );

if( ! function_exists( 'halcyon_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function halcyon_update_admin_notice(){
    if ( isset( $_GET['halcyon_admin_notice'] ) && $_GET['halcyon_admin_notice'] = '1' ) {
        update_option( 'halcyon_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'halcyon_update_admin_notice' );

if( ! function_exists( 'halcyon_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function halcyon_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'halcyon_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function halcyon_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = halcyon_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#dedbdb;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if( ! function_exists( 'halcyon_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function halcyon_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by Raleway, translate this to 'off'. Do not translate into your own language.
    */
    $raleway = _x( 'on', 'Raleway font: on or off', 'halcyon' );
    
    /*
    * translators: If there are characters in your language that are not supported
    * by Lato, translate this to 'off'. Do not translate into your own language.
    */
    $lato = _x( 'on', 'Lato font: on or off', 'halcyon' );

    if ( 'off' !== $raleway || 'off' !== $lato ) {
        $font_families = array();

        if( 'off' !== $raleway ){
            $font_families[] = 'Raleway:400,500,600,700';
        }

        if( 'off' !== $lato ){
            $font_families[] = 'Lato:400,700';
        }

        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'display' => urlencode( 'fallback' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}
endif;