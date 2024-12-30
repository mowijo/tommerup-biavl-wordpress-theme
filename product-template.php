<?php
/*
Template Name: Product Template
*/

$page_title = get_the_title();

include("page_start_and_menu.php");
the_post();
?>


<section id="productDisplayAsTable">
<?php
$content = get_the_content( null, false );
$content = apply_filters( 'the_content', $content );
$content = str_replace( ']]>', ']]&gt;', $content );
$tags = new WP_HTML_Tag_Processor( $content );

$previousTag = "";
while ( $tags->next_tag() ) {
    $currentTag = $tags->get_tag();
    if($currentTag == "P" && $previousTag == "IMG")
    {
        $tags->set_attribute("style", "margin-top: -2rem;");

    }
    $previousTag = $currentTag;
}
echo $tags->get_updated_html();
?>
<p style="text-align: right;">
  <img style="width: 15rem;" src="<?php echo get_template_directory_uri(); ?>/assets/images/honey-booth-with-white-background.png"/>
</p>
</section>


<section id="productDisplayAsFlow">
<?php
$content = get_the_content( null, false );
$content = apply_filters( 'the_content', $content );
$content = str_replace( ']]>', ']]&gt;', $content );
$tags = new WP_HTML_Tag_Processor( $content );

$previousTag = "";
while ( $tags->next_tag() ) {
    $currentTag = $tags->get_tag();
    echo $currentTag."<br/>";
    if($currentTag == "P" && $previousTag == "IMG")
    {
        $tags->set_attribute("style", "margin-top: -2rem;");

    }
    $previousTag = $currentTag;
}
echo $tags->get_updated_html();
?>

    <img style="width: 15rem;" src="<?php echo get_template_directory_uri(); ?>/assets/images/honey-booth-with-white-background.png"/>
</section>

<?php
    include ("page_end_and_footer.php");
?>
