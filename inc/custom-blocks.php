<?php

// custom gutenberg

/**
 * Add a block category for "Get With Gutenberg" if it doesn't exist already.
 *
 * @param array $categories Array of block categories.
 *
 * @return array
 */
function creatio_block_categories( $block_categories, $block_editor_context ) {
    // if ( $post->post_type !== 'post' ) {
    //     return $categories;
    // }

    return array_merge(
        $block_categories,
        array(
            array(
                'slug' => 'creatio-blocks',
                'title' => __( 'Creatio Blocks', 'creatio' ),
                'icon'  => 'wordpress',
            ),
        )
    );
}
add_filter( 'block_categories_all', 'creatio_block_categories' , 10, 2 );

add_action('acf/init', 'creatio_acf_init_blocks');
function creatio_acf_init_blocks() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // Section with video bg block.
        acf_register_block_type(array(
            'name'              => 'Section With Video Background',
            'title'             => 'Section With Video Background',
            'description'       => 'Block to add Section With Video Background',
            'mode'			=> 'preview',
            'category'          => 'creatio-blocks',
            // 'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                // 'mode' => false,
                'jsx' => true
            ),
            'render_template' => 'template-parts/blocks/section-with-video-bg/section-with-video-bg.php',
        ));


         // Tours Section
         acf_register_block_type(array(
            'name'              => 'Tours Section',
            'title'             => 'Tours Section',
            'description'       => 'Block to add Tours Section',
            'mode'			=> 'preview',
            'category'          => 'creatio-blocks',
            // 'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                // 'mode' => false,
                'jsx' => true
            ),
            'render_template' => 'template-parts/blocks/section-tours/section-tours.php',
        ));


          // Music Section
          acf_register_block_type(array(
            'name'              => 'Music Section',
            'title'             => 'Music Section',
            'description'       => 'Block to add Music Section',
            'mode'			=> 'preview',
            'category'          => 'creatio-blocks',
            // 'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                // 'mode' => false,
                'jsx' => true
            ),
            'render_template' => 'template-parts/blocks/section-music/section-music.php',
        ));



        // Live Archive Section
        acf_register_block_type(array(
            'name'              => 'Live Archive Section',
            'title'             => 'Live Archive Section',
            'description'       => 'Block to add Live Archive Section',
            'mode'			=> 'preview',
            'category'          => 'creatio-blocks',
            // 'mode'              => 'preview',
            'supports'          => array(
                'align' => true,
                // 'mode' => false,
                'jsx' => true
            ),
            'render_template' => 'template-parts/blocks/section-live-archive/section-live-archive.php',
        ));





    }
}