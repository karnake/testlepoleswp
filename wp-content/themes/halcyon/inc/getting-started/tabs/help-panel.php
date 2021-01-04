<?php
/**
 * Help Panel.
 *
 * @package Halcyon
 */
?>
<!-- Help file panel -->
<div id="help-panel" class="panel-left">

    <div class="panel-aside">
        <h4><?php esc_html_e( 'View Our Documentation Link', 'halcyon' ); ?></h4>
        <p><?php esc_html_e( 'Are you new to the WordPress world? Our step by step easy documentation guide will help you create an attractive and engaging website without any prior coding knowledge or experience.', 'halcyon' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://docs.rarathemes.com/docs/halcyon/' ); ?>" title="<?php esc_attr_e( 'Visit the Documentation', 'halcyon' ); ?>" target="_blank">
            <?php esc_html_e( 'View Documentation', 'halcyon' ); ?>
        </a>
    </div><!-- .panel-aside -->
    
    <div class="panel-aside">
        <h4><?php esc_html_e( 'Support Ticket', 'halcyon' ); ?></h4>
        <p><?php printf( __( 'It\'s always better to visit our %1$sDocumentation Guide%2$s before you send us a support query.', 'halcyon' ), '<a href="'. esc_url( 'https://docs.rarathemes.com/docs/halcyon/' ) .'" target="_blank">', '</a>' ); ?></p>
        <p><?php printf( __( 'If the Documentation Guide didn\'t help you, contact us via our %1$sSupport Ticket%2$s. We reply to all the support queries within one business day, except on the weekends.', 'halcyon' ), '<a href="'. esc_url( 'https://rarathemes.com/support-ticket/' ) .'" target="_blank">', '</a>' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/support-ticket/' ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'halcyon' ); ?>" target="_blank">
            <?php esc_html_e( 'Contact Support', 'halcyon' ); ?>
        </a>
    </div><!-- .panel-aside -->

    <div class="panel-aside">
        <h4><?php esc_html_e( 'View Our Halcyon Demo', 'halcyon' ); ?></h4>
        <p><?php esc_html_e( 'Visit the demo to get more idea about our theme design and its features.', 'halcyon' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( 'https://rarathemes.com/previews/?theme=halcyon' ); ?>" title="<?php esc_attr_e( 'Visit the Demo', 'halcyon' ); ?>" target="_blank">
            <?php esc_html_e( 'View Demo', 'halcyon' ); ?>
        </a>
    </div><!-- .panel-aside -->
</div>