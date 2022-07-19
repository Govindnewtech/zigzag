// zigzag post grid

  function post_zigzag($attr, $content = null){

    global $post;

    // Defining Shortcode's Attributes
    $shortcode_args = shortcode_atts(
                        array(
                                'cat'     => '',
                                'num'     => '3',
                                'order'  => 'desc'
                        ), $attr);    
     
    // array with query arguments
    $args = array(
                    'cat'            => $shortcode_args['cat'],
                    'posts_per_page' => $shortcode_args['num'],
                    'order'          => $shortcode_args['order'],
                     
                 );
    

  // $type = 'post';
  
  // $args=array('category__in'=> array(4), 'post_type' => $type, 'posts_per_page'=>3, 'order'=>'DESC');

  $my_query = new WP_Query($args);
  $i=1;
  while ($my_query->have_posts()) : $my_query->the_post(); ?>
  <div class="container">
    <div class="row_grid">
      <div class="col-6 <?php if($i%2==1){ echo 'order-sm-2';} ?>">
        <figure class="pro-innerpage-img">
        <?php the_post_thumbnail(); ?>
        </figure>
      </div>
      <div class="col-6 text_blog">
        <div class="title_content">
        <h2 class="title_h "><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</div>
		<div class="content_div">
	
          <?php $content = get_the_content();
           $trimmed_content = wp_trim_words( $content, 40, '</br></br><a href="'. get_permalink() .'"class="zig_btn">read more</a>' ); ?>
          <p class="text_blog"><?php echo $trimmed_content; ?></p>

     
		</div>

     
    </div>
  </div>
  </div>
<?php
$i++;
endwhile;
wp_reset_query();

}
add_shortcode('zigzag_grid', 'post_zigzag');
