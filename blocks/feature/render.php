<?php
/**
 * Feature Block Template.
 *
 * @package developer-assignment
 */

// Dynamic Block ID
$block_id = $block['id'];

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Load ACF values and assign defaults.
$title              = get_field( 'feature_title' )?: 'Your title here...';
$content            = get_field( 'feature_content' )?: 'Your content here...';
$button             = get_field( 'feature_button' );
$button_bg_color    = get_field( 'feature_button_bg' )?: '#2fb297';
$button_color       = get_field( 'feature_button_color' )?: '#eeeeee';
$image              = get_field( 'feature_image' );
$image_position     = get_field( 'feature_image_position' );
$image_position_mob = get_field( 'feature_image_position_mob' );
$mobile_breakpoint  = get_field( 'feature_mobile_breakpoint' );

// Inline button styles
$btn_style = 'style="background-color:' . $button_bg_color . '; color:' . $button_color . ';"';

/**
 * $content custom html output for CSS only read more toggle - I dunno why I did it like this :)
 */

$content_p = explode( '</p>', $content );
$count_p = count( $content_p );

// Aditional class for .col-content if has more than one paragraph
$has_readmore = '';

if ( $count_p > 1 ) {
    $has_readmore = 'has-readmore';
    $content_html = '<input type="checkbox" class="read-more-state" id="expand_' . $block_id . '">';
    $content_html.= $content_p[0] .'<label for="expand_' . $block_id . '" class="read-more-trigger"></label>';
    $content_html.= '<div class="read-more-wrap">' . implode( '', array_slice( $content_p , 1 ) ). '</div>';
} else {
    $content_html = $content;
}

/**
 * Render the block output
 */

?>

<section <?php echo $anchor;?> <?php echo get_block_wrapper_attributes(); ?>>

    <div id="<?php echo $block_id; ?>" class="block-feature-container">

        <div class="block-feature-row <?php echo $image_position.' '.$image_position_mob; ?>">

            <div class="block-feature-col col-content <?php echo $has_readmore; ?>">

                <h1><?php echo $title; ?></h1>

                <div class="feature-content">
                    <?php
                        echo ( $content_html );
                    ?>
                </div>

                <?php if ( $button ):
                    $button_url = $button['url'];
                    $button_title = $button['title'];
                    $button_target = $button['target'] ? $button['target'] : '_self';
                ?>
                <a class="button" <?php echo $btn_style ?> href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>">
                    <?php echo esc_html( $button_title ); ?>
                </a>

                <?php endif; ?>

            </div>

            <div class="block-feature-col col-image">

                <?php if ( $image ) {
                    echo wp_get_attachment_image( $image, 'full' );
                } else { ?>
                    <img class="no-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-no-image.svg" width="300" height="300" alt="no-image">
                <?php } ?>

            </div>

        </div>

    </div>

</section>

<?php
/**
 * Add inline style for each Feature Block $mobile_breakpoint value by $block_id.
 */
?>

<style>

    @media( max-width:<?php echo $mobile_breakpoint; ?>px ) {

        <?php echo '#'.$block_id.'';?> .block-feature-col {
            width: 100%;
        }
        <?php echo '#'.$block_id.'';?> .block-feature-row.image-above {
            flex-direction: column-reverse;
        }
        <?php echo '#'.$block_id.'';?> .block-feature-row.image-left .col-content,
        <?php echo '#'.$block_id.'';?> .block-feature-row.image-right .col-content,
        <?php echo '#'.$block_id.'';?> .block-feature-row.image-left .col-image,
        <?php echo '#'.$block_id.'';?> .block-feature-row.image-right .col-image {
            padding-left: 0;
            padding-right: 0;
        }
        <?php echo '#'.$block_id.'';?> .block-feature-row.image-above .col-image {
            margin-bottom: 1.25rem;
        }
        <?php echo '#'.$block_id.'';?> .col-content h1 {
            font-size: 2rem;
        }
        <?php echo '#'.$block_id.'';?> .col-content p {
            font-size: 1.125rem;
        }
        <?php echo '#'.$block_id.'';?> .read-more-wrap {
            display: block;
        }
        <?php echo '#'.$block_id.'';?> .read-more-trigger {
            display: none;
        }

    }

</style>
