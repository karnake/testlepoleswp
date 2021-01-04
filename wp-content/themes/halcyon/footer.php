<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Halcyon
 */

?>

            </div><!-- .row -->
        </div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo" itemscope itemtype="https://schema.org/WPFooter">

        <?php if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ){?>
        <div class="widget-area">
			<div class="container">
				<div class="row">

                    <?php if( is_active_sidebar( 'footer-one' ) ){?>
                    <div class="column">
						<?php dynamic_sidebar( 'footer-one' ); ?>
					</div>
                    <?php } ?>

                    <?php if( is_active_sidebar( 'footer-two' ) ){?>
                    <div class="column">
						<?php dynamic_sidebar( 'footer-two' ); ?>
					</div>
                    <?php } ?>

                    <?php if( is_active_sidebar( 'footer-three' ) ){?>
                    <div class="column">
						<?php dynamic_sidebar( 'footer-three' ); ?>
					</div>
                    <?php } ?>

				</div>
			</div>
		</div>
        <?php } ?>
        <div class="site-info">
            <p>
                <?php 
                echo esc_html__( 'Copyright &copy; ', 'halcyon' ) . date_i18n( esc_html__( 'Y', 'halcyon' ) ); 
                echo '<a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a> &middot; ';
                esc_html_e( 'Halcyon | Developed By ', 'halcyon' );
                echo '<a href="'. esc_url( 'https://rarathemes.com/' ) .'" rel="nofollow" target="_blank">Rara Theme</a> &middot; ';                
                printf( esc_html_x( 'Powered by: %s', 'WordPress link', 'halcyon' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'halcyon' ) ) .'" target="_blank">WordPress</a>' );
                if( function_exists( 'get_the_privacy_policy_link' ) ){
                    echo ' &middot; ' . get_the_privacy_policy_link();
                }
                ?>
            </p>
        </div>

	</footer><!-- #colophon -->
    <div class="overlay"></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
