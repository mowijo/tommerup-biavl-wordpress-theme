<?php
/*
This template is the default template for ordinary pages. It should not be applied to:


 - The front page
 - Products.


*/
$page_title = get_the_title();
include("page_start_and_menu.php");
?>
<section>

    <?php
       if (have_posts())
       {
           while (have_posts())
           {
                the_post();



                $content = get_the_content( null, false );
                $content = apply_filters( 'the_content', $content );
                $content = str_replace( ']]>', ']]&gt;', $content );
                $tags = new WP_HTML_Tag_Processor( $content );

                $previousTag = "";
                while ( $tags->next_tag() ) {
                    $currentTag = $tags->get_tag();
                    if($currentTag == "P" && $previousTag == "IMG")
                    {
                        $tags->set_attribute("style", "min-height: 22rem; margin-top: -2rem;");

                    }
                    $previousTag = $currentTag;
                }
                echo $tags->get_updated_html();


            }
       }
       else
       {
           ?>
           <p><?php esc_html_e('Sorry, no content available.'); ?></p>
       <?php
       }
       ?>

</section>

<?php
    include ("page_end_and_footer.php");
?>
