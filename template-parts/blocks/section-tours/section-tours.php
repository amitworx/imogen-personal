<?php

/**
 *  Tours Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */



// Create id attribute allowing for custom "anchor" value.
$id = 'tour-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


 // Create class attribute allowing for custom "className" and "align" values.
$classes = 'tours__block';
if( !empty($block['className']) ) {
    $classes .= sprintf( ' %s', $block['className'] );
}
if( !empty($block['align']) ) {
    $classes .= sprintf( ' align%s', $block['align'] );
}

?>




 <p class="tours__block--editor-title"> Tours Block </p>
 <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>" >
       
 </div>