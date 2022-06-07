<?php 
if ( is_singular( 'post' ) ):
    //your code here...
?>
         <div class="article__wrapper">
                <div style="height:95px" aria-hidden="true" class="wp-block-spacer"></div>
                   <div class="back__to-blog wide__container m-b-3">
                        <a href="<?php echo site_url('/imail'); ?>">	
                            <svg xmlns="http://www.w3.org/2000/svg" width="24.411" height="10.381" viewBox="0 0 24.411 10.381">
                                <g id="Group_16" data-name="Group 16" transform="translate(-77.307 -130.154)">
                                    <path id="Path_17" data-name="Path 17" d="M2356.976,130l-4.643,4.844,4.643,4.844" transform="translate(-2274.332 0.5)" fill="none" stroke="#919191" stroke-width="1"/>
                                    <line id="Line_6" data-name="Line 6" x2="23.617" transform="translate(78.102 135.344)" fill="none" stroke="#919191" stroke-width="1"/>
                                </g>
                            </svg>

                            <span>Back to Blog</span>
                        </a>

                    </div>
         
            <article class="article">
                  

                   <div class="article__title">
                        <h1><?php the_title(); ?></h1>   
                   </div>
                   <div class="article__content">
                           <?php the_content(); ?>
                   </div>


                   <div class="article__author"> 
                       <span> 
                           <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>">
                            <?php the_author(); ?>
                        </a>
                        </span>
                    </div>
           </article>

           </div>

<?php else:
    //your code here...  blog index page    
?>   
   
      
            <article class="article">
               
                <div class="article__image">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                    <div class="overlay">
                        
                    </div>
                </div>
                <div class="article__date">
                      <time class="blog__date">
                         <?php the_time('j/m/y'); ?>
                      </time>  
                </div>

                <div class="article__content">
                    <div class="article__title">
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                        </a>
                    </div>
                    <div class="article__excerpt">
                            <?php the_excerpt(); ?>
                    </div>
                </div>

                <div class="article__read-more"> 
                        <a href="<?php the_permalink(); ?>">
                            Read More
                        </a>
                </div>
            </article>
      
 
<?php endif; ?>