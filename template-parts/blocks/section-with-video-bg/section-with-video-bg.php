<?php

/**
 * Video BG SEction Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'section__video-bg-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'section__video-bg';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$background_video_id = get_field('background_video_id');



?>






<section  id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
        <div class="video__bg" data-ytbg-play-button="true" data-youtube="https://www.youtube.com/watch?v=<?php echo $background_video_id ;?>"></div>
        <div class="section__video-bg-content">
            <div class="block__content">
                <?php	echo '<InnerBlocks />' ;?>
            </div>
        </div>
</section>

   






