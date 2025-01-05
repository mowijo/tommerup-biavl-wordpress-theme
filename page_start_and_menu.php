<?php
$menu_name = 'primary-menu'; // Replace with your menu location slug
$locations = get_nav_menu_locations();


function build_menu($menu_items, $indentation, $parent_id = 0) {
    $output = "";

    foreach ($menu_items as $item) {
        if ($item->menu_item_parent == $parent_id) {
            $submenu = build_menu($menu_items, $indentation."      ", $item->ID);



	    // We hide all pages NOT "publish"-ed;
	    $linked_post = get_post($item->object_id);
	    if($linked_post->post_status != "publish")
	    {
              continue;
            }

            $output .= $indentation."   <li> " ;
            $output .= "<a";
            if( empty($submenu) )
            {
                $output .= " href=\"" . esc_url($item->url) . "\"";
            }
            $output .= ">";
            $output .= esc_html($item->title);
            $output .= "</a>";

            // Check if this item has children
            if (!empty($submenu)) {
                $output .= $submenu;
            }
            elseif( $parent_id == 0)
            {
                    $output .= "\n".$indentation."<ul style=\"display: none;\"></ul>\n";
            }

            $output .= "</li>\n";
        }
    }
    if($output != "")
    {
        $topLevelClasses = "";
        if($parent_id == 0)
        {
            $topLevelClasses = " class=\"multilevel-dropdown-menu\" id=\"multilevel-dropdown-menu\"";
        }

        $output = "\n".$indentation."<ul".$topLevelClasses.">\n".$output."\n".$indentation."</ul>\n";
    }
    return $output;
}

$menu_html = "No menu created";
if (isset($locations[$menu_name])) {
    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    $menu_html = build_menu($menu_items, "");
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
<style>


/** RESET **/


html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
font-family: Arial, sans-serif;
}

/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
    display: block;
}
body {
    line-height: 1;
}

blockquote, q {
    quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
    content: '';
    content: none;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
/* RESET DONE */

h1 {
padding-top: 1rem;
font-weight: bold;

}


h2 {
padding-top: 1rem;
font-weight: bold;

}

section p, section h1, section h2, section ul, footer p, section section, section.productDisplay
{
max-width: 60em;
margin: auto;
padding-bottom: 1em;
}

}


section
{
        border-bottom: 1px solid var(--tbaDarkYellow);

}

section p {
margin-bottom: 1em;

}
footer
{
    border: none;
    width: 100%;
    background-color: var(--tbaYellow);

    text-align: center;
}

footer p
{
    margin-bottom: none;
}

body
{
    background-color: var(--tbaYellow);
}


section {
padding-top: 2em;
padding-bottom: 2em;
background-color: white;

}
    :root {
    --tbaYellow: #fdf9d9;
    --tbaDarkYellow: #f6b24e;
    --blueText: #ffffff;
    --blueHeadline: #f06c21;
    --blueShadow: rgba(13,61,83, 0.1);

    --white: #ffffff;
    --whiteText: #0d3d53;
    --whiteHeadline: #0d3d53;

    --orange: #f06c21;
    --menuText: #f06c21;
    }




@media (pointer: coarse)
{

nav
{
    margin: auto;
            border-bottom: 1px solid var(--tbaDarkYellow);

}



#toggleDiv
{
    font-size: 6rem;
    width: 100%;
    display: block;
    text-align: center;
    padding-top: 1rem;
    padding-bottom: 1rem;
}

#multilevel-dropdown-menu
{
    display: none;
    }

#toggleCheckbox:checked + #multilevel-dropdown-menu
{
    display: inline-block;
}

ul {
    list-style-type: none; /* Remove bullet points */
    max-width: 60rem;
    padding: 0; /* Remove default padding */
    margin: auto; /* Remove default margin */
}

nav > ul
{
    padding: 0; /* Remove default padding */
}


ul li
{
    text-align: left; /* Center the text within each <li> */
    display: block;
    max-width: 60rem;
}


ul li a
{
    text-decoration: none; /* Remove underline from links */
    text-align: left; /* Center the text within each <li> */
    display: block;
    padding: 10px; /* Optional: Add padding for better spacing */
    font-size: 3rem;
    font-family: Arial, sans-serif;
    color: black;
}



/* Level 0 (top-level <li>) */
.multilevel-dropdown-menu > li
{
    font-size: 3rem;
    margin-left: 4rem;
    display: block;
}

/* Level 1 (<li> inside first level <ul>) */
.multilevel-dropdown-menu > li > ul > li
{
    font-size: 2rem;
    margin-left: 4rem;
    display: block;
}

/* Level 2 and deeper (<li> inside second level <ul> or deeper) */
.multilevel-dropdown-menu > li > ul > li > ul > li,
.multilevel-dropdown-menu > li > ul > li > ul > li > ul > li
{
    font-size: 1rem;
    margin-left: 4rem;
    display: block;
}
}


nav h1
{
margin: auto;
text-align: center;
padding-bottom: 1rem;
font-size: 2rem;
font-weight: normal;

}
/* CONTACT FORM*/


@media (pointer: fine)
{
    .contactForm
    {
        width: 20em;
    }
}

@media (pointer: coarse)
{
    .contactForm
    {
        width: 95%;
    }
    input, textarea
    {
        font-size: 3em;
    }
    textarea
    {
        height: 30rem;
    }
}


/* PRODUCTS */


section.product
{
min-height: 20rem;
}

section.product #booth
{
height: 20rem;
float: right;
}


section.product img.productPhoto
{
height: 20rem;
float: left;
margin-right: 1rem;
margin-bottom: 1rem;
border: 1px solid var(--tbaDarkYellow);

}

img + p {
  min-height: 22rem;
}

</style>

<link rel="stylesheet" href="<?=get_template_directory_uri();?>/menu.css" type="text/css" media="all" />
</head>


<body>
<header>
    <nav>
        <h1><?=$page_title;?></h1>
        <label for="toggleCheckbox" id="toggleDiv" >☰</label>
        <input type="checkbox" id="toggleCheckbox" style="display: none;" />
        <?=$menu_html;?>
    </nav>
</header>
