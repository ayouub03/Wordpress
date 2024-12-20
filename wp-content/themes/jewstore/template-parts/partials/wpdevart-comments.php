<?php
    if ( comments_open() || get_comments_number() ) {
        ?> <div class="wpdevart-comment-respond">
                <?php comments_template(); ?> 
            </div>
        <?php
    }
?>