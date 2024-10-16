<?php

$footer_logo = get_field('footer_logo', 'options');
$footer_cta = get_field('footer_cta', 'options');

$cta_link = $footer_cta['url'];
$cta_target = $footer_cta['target'];
$cta_title = $footer_cta['title'];

$social_media_title = get_field('social_media_title', 'options');


$linkedin_url = get_field('linkedin_url', 'options');
$facebook_url = get_field('facebook_url', 'options');
$twitter_url = get_field('twitter_url', 'options');
$instagram_url = get_field('instagram_url', 'options');

$copy_right_text = get_field('copy_right_text', 'options');



?>

<!-- Begin footer -->
<footer>
   <!-- Begin footer top content -->
   <div class="footer-top-content">
      <div class="container container-1200">
         <div class="row reset-margin">
            <div class="col-lg-3 col-md-3 col-sm-12 reset-padding">
               <?php if ($footer_logo) { ?>
                  <div class="footer-logo">
                     <div class="widget widget_media_image">
                        <div class="widget-content"><img width="83" height="91" src="<?php echo $footer_logo['url']; ?>"
                              class="image wp-image-51  attachment-full size-full" alt=""
                              style="width: 175px;max-width: 100%; height: auto;" decoding="async" loading="lazy" /></div>
                     </div>
                  </div>
               <?php } ?>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 reset-padding">
               <div class="footer-menu">
                  <div class="widget widget_nav_menu">
                     <div class="widget-content">
                        <nav class="menu-footer-menu-container" aria-label="Menu">
                           <?php
                           if (has_nav_menu('footer_menu')) {
                              ?>
                              <?php
                              wp_nav_menu(
                                 array(
                                    'theme_location' => 'footer_menu',
                                    'menu_id' => 'menu-footer-menu',
                                    'menu_class' => 'menu',
                                 )
                              );
                              ?>
                              <?php
                           } ?>
                        </nav>
                     </div>
                  </div>
                  <?php
                  if ($footer_cta) {
                     ?>
                     <a href="<?php echo $cta_link ?>" target="<?php echo $cta_target; ?>"
                        class="request_label"><?php echo $cta_title; ?></a>
                  <?php } ?>
               </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 reset-padding">
               <div class="footer-social-networking">
                  <div class="widget widget_text">
                     <div class="widget-content">
                        <div class="textwidget">
                           <?php
                           if ($social_media_title) {
                              ?>
                              <h3 class="socialIcon_intro"><?php echo $social_media_title; ?></h3>
                           <?php } ?>
                           <ul>
                              <?php
                              if ($linkedin_url) { ?>
                                 <li><a href="<?php echo $linkedin_url; ?>" class="fa fa-linkedin"></a></li>
                              <?php }

                              if ($facebook_url) { ?>
                                 <li><a href="<?php echo $facebook_url; ?>" class="fa fa-facebook"></a></li>
                              <?php }

                              if ($twitter_url) { ?>
                                 <li><a href="<?php echo $twitter_url ?>" class="fa fa-twitter"></a></li>
                              <?php }

                              if ($instagram_url) { ?>
                                 <li><a href="<?php echo $instagram_url ?>" class="fa fa-instagram"></a></li>
                              <?php } ?>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- End of footer top content -->
   <div class="footer-bottom-content">
      <div class="container container-1200">
         <div class="row reset-margin">
            <div class="copy-right col-md-8 col-sm-12 reset-padding">
               <?php if ($copy_right_text) { ?>
                  <p><?php echo $copy_right_text; ?></p>
               <?php } ?>
            </div>

            <div class="bottom-menu-bar col-md-4 col-sm-12 reset-padding">
               <?php
               if (has_nav_menu('bottom_menu')) {
                  ?>
                  <?php
                  wp_nav_menu(
                     array(
                        'theme_location' => 'bottom_menu',
                        'menu_id' => 'menu-footer-bottom-menu',
                        'menu_class' => 'mr-auto',
                     )
                  );
                  ?>
                  <?php
               } ?>
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- End footer -->
</div>


<?php wp_footer(); ?>

   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js?ver=6.6.2" id="popper.min.js-js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js?ver=6.6.2" id="bootstrap.min.js-js"></script>



</body>

</html>