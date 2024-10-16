<?php
$hero_sections = get_field('hero_section');
?>

         <div id="demo" class="landingpage_slider carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
               <li data-target="#demo" data-slide-to="0" class="active"></li>
               <li data-target="#demo" data-slide-to="1" class=""></li>
            </ul>
            <div class="carousel-inner">
      <?php
      if (!empty($hero_sections)) {
         foreach ($hero_sections as $sections) {
            $title = $sections['hero_title'];
            $desc = $sections['hero_description'];
            $banner_image = $sections['banner_image']['url'];
            ?>
            <div class="carousel-item ">
               <div class="landing_page_banner container-fluid reset-padding">
                  <div class="container container-1280">
                     <div class="row reset-margin">
                        <div class="col-md-6 content-box">
                           <?php if ($title) { ?>
                              <h1><?php echo $title; ?></h1>
                           <?php }
                           if ($desc) { ?>
                              <?php echo $desc; ?>
                           <?php } ?>
                        </div>
                        <?php if ($banner_image) { ?>
                           <div class="col-md-6 featured_img_box">
                              <img src="<?php echo $banner_image; ?>" style="width:100%;" />
                           </div>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
            <?php
         }
      } ?>
   </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            </a>
         </div>