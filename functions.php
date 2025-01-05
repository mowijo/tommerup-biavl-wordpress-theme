<?php

function my_theme_register_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary Menu' ),
        )
    );
}
add_action( 'after_setup_theme', 'my_theme_register_menus' );


function enqueue_tba_stylesheet() {
    wp_enqueue_style(
        'tba-product-style', // Handle for the stylesheet
        get_template_directory_uri() . '/products.css', // Path to the stylesheet
        array(), // Dependencies (none in this case)
        '1.0.0', // Version number
        'all' // Media type
    );
}
add_action('wp_enqueue_scripts', 'enqueue_tba_stylesheet');




function custom_render_block_content($block_content, $block) {


if($block["blockName"] ==  "core/image")
{
        $align = "right";
        $marginPosition = "left";
        $attr = $block["attrs"];


        preg_match('/<img\s+src="([^"]+)"/', $block_content, $matches);

        if (isset($matches[1])) {
            $url = $matches[1];  // The src URL
        } else {
            return $block_content;
        }


        if (strpos($block_content, "alignright"))
        {
            $align = "right";
            $marginPosition = "left";
        } elseif (strpos($block_content, "alignleft"))
        {
                $align = "left";
                $marginPosition = "right";
        } else
        {
            return $block_content;
        }


        return "<p><img src=\"$url\" style=\"float: $align; height: 20rem; border: 1px solid var(--tbaDarkYellow); margin-$marginPosition: 1rem;\"/></p>";
    }

/*


// Loop through the HTML tags and modify the first <p> element.
$processor->each(function( $tag ) use ( &$first_paragraph_found ) {
if ( 'p' === $tag->name() && !$first_paragraph_found ) {
    // Add inline style to the first <p> element
    $style = $tag->attr('style');
    if (!$style) {
        // If there is no existing style, create a new one.
        $tag->set_attr('style', 'border: 1px solid red;');
    } else {
        // If there's already a style, append the new style.
        $tag->set_attr('style', $style . ' border: 1px solid red;');
    }

    $first_paragraph_found = true;
}
});

    return $processor->get_updated_html();

*/



    // For all other blocks, return the default block content (this will render them as Gutenberg intends)
    return $block_content; // Gutenberg will render it normally
}
add_filter('render_block', 'custom_render_block_content', 10, 2);


?>
