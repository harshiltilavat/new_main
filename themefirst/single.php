<?php /* Template Name: Single */ ?>

<?php get_header(); ?>

<section class = "page-wrap">  

<div class = "container">

<h3>Username: <?php the_title(); ?></h3><br>

<div class='post-content'>
    
    <?php the_content();
            
            if (has_post_thumbnail()) 
            {
                the_post_thumbnail('thumbnail');
            }    
    ?>

</div><br>
            <p><strong>Email:</strong> <?php echo get_field('email'); ?></p>
            <p><strong>Gender:</strong> <?php echo get_field('gender'); ?></p>
            <p><strong>Mobile Number:</strong> <?php echo get_field('mobile'); ?></p>
            <p><strong>Hobbies:</strong> 
            
            <?php 
            $post_id = $post->ID;

            $hobbies = get_field('hobbies', $post_id, true); ?></p>
                       
            <?php
            
            if (!empty($hobbies) && is_array($hobbies)) {
                echo '<ul>';
                foreach ($hobbies as $hobby) {
                    echo '<li>' . esc_html($hobby) . '</li>';
                }
                echo '</ul>';
            }
            

?></p>

</div>
</section>

<?php get_footer(); ?>