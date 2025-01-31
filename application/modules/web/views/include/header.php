<header class="mkd-page-header">
               <div class="mkd-logo-area">
                  <div class="mkd-grid">
                     <div class="mkd-vertical-align-containers">
                        <div class="mkd-position-left">
                           <div class="mkd-position-left-inner">
                              <div class="mkd-logo-wrapper">
                                 <a href="<?= base_url() ?>" style="height:100px;">
                                 <img class="mkd-normal-logo" src="<?= base_url('assets/website_assets/images/Sanskar Logo.png'); ?>" alt="logo" /> 
                                 </a>
                              </div>
                           </div>
                        </div>
<!--                        <div class="mkd-position-right">
                           <div class="mkd-position-right-inner">
                              <div class="widget mkd-image-widget">
                                 <a href="#" target="_self"><img src="<?= base_url('assets/website_assets/images/Home_page_add.jpg') ?>" alt="a" /></a> 
                              </div>
                           </div>
                        </div>-->
                     </div>
                  </div>
               </div>
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <i class="fa fa-bars"></i>
   <!-- <span class="navbar-toggler-icon"></span>-->
  </button>

                               <nav class="navbar navbar-expand-lg navbar-dark bg-primary mobile-view-bg-color">
    <div class="mkd-grid">
 <!--<a class="navbar-brand" href="<?= base_url() ?>" style="max-width: 130px;"> 
    <img src="<?= base_url('assets/website_assets/images/Sanskar Logo.png'); ?>" alt="mobile-logo" />
    </a>-->

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mkd-active-item">
      <li class="nav-item <?=($active_menu=='home'?'active':'')?>">
        <a class="nav-link" href="<?= base_url() ?>">Home</a>
      </li>
      <li class="nav-item dropdown menu-item <?=($active_menu=='bhajan'?'active':'')?>">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Bhajans  <span class="fa fa-angle-down"></span>
        </a>
        <div class="dropdown-menu mkd-grid" aria-labelledby="navbarDropdown">
          <div class="mkd-grid">
            <div class="row">
             <div class="mkd-menu-second">
              <div class="mkd-menu-inner mt-4">
                 <ul>
                    <li id="nav-menu-item-1680" class="menu-item menu-item-type-custom menu-item-object-custom ">
                       <div class="widget mkd-plw-six">
                          <div class="mkd-bnl-holder mkd-pl-six-holder  mkd-post-columns-5">
                             <div class="mkd-bnl-outer">
                                <div class="mkd-bnl-inner">
                                   <?php foreach ($bhajan_list as $bhajan) { ?>
                                   <div class="mkd-pt-six-item mkd-post-item">
                                      <div class="mkd-pt-six-image-holder">
                                         <a itemprop="<?= base_url('bhajan/'.$bhajan['id'])?>" class="mkd-pt-six-slide-link mkd-image-link" href="<?= base_url('bhajan/'.$bhajan['id'])?>" target="_self">
                                         <img src="<?= $bhajan['image']; ?>" alt="a" width="234" height="153" /> <span class="mkd-post-info-icon-holder">
                                         <span class="mkd-post-info-icon mkd-post-video"></span>
                                         </span> </a>
                                      </div>
                                      <div class="mkd-pt-six-content-holder">
                                         <div class="mkd-pt-six-title-holder">
                                            <h6 class="mkd-pt-six-title">
                                               <a itemprop="url" class="mkd-pt-link" href="<?= base_url('bhajan/'.$bhajan['id'])?>" target="_self"><?= $bhajan['title']; ?></a>
                                            </h6>
                                         </div>
                                         <div itemprop="dateCreated" class="mkd-post-info-date entry-date updated">
                                            <?= date("F d, Y", $bhajan['creation_time'] / 1000); ?>
                                            <meta itemprop="interactionCount" content="UserComments: 0" />
                                         </div>
                                      </div>
                                   </div>
                                   <?php }
                                      ?>
                                </div>
                             </div>
                          </div>
                       </div>
                    </li>
                 </ul>
              </div>
           </div>
            </div>
          </div>
          <!--  /.container  -->


        </div>
      </li>
      <li class="nav-item dropdown menu-item <?=($active_menu=='news'?'active':'')?>">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          News <span class="fa fa-angle-down"></span>
        </a>
        <div class="dropdown-menu mkd-grid" aria-labelledby="navbarDropdown">


          <div class="mkd-grid">
            <div class="row">
              <div class="mkd-menu-second" style="padding: 0px 40px;">
                              <div class="mkd-menu-inner mt-4">
                                 <ul>
                                    <li id="nav-menu-item-1680" class="menu-item menu-item-type-custom menu-item-object-custom ">
                                       <div class="widget mkd-plw-six">
                                          <div class="mkd-bnl-holder mkd-pl-six-holder  mkd-post-columns-5">
                                             <div class="mkd-bnl-outer">
                                                <div class="mkd-bnl-inner">
                                                   <?php foreach ($news_list as $news) {
                                                       $news_image = explode(',', $news['image']);
                                                       ?>
                                                   <div class="mkd-pt-six-item mkd-post-item">
                                                      <div class="mkd-pt-six-image-holder">
                                                         <a itemprop="<?= base_url('news/'.$news['id'])?>" class="mkd-pt-six-slide-link mkd-image-link" href="<?= base_url('news/'.$news['id'])?>" target="_self">
                                                         <img src="<?= $news_image[0]; ?>" alt="a" width="234" height="153" /> <span class="mkd-post-info-icon-holder">
                                                         </span> </a>
                                                      </div>
                                                      <div class="mkd-pt-six-content-holder">
                                                         <div class="mkd-pt-six-title-holder">
                                                            <h6 class="mkd-pt-six-title">
                                                               <a itemprop="url" class="mkd-pt-link" href="<?= base_url('news/'.$news['id'])?>" target="_self"><?= $news['title']; ?></a>
                                                            </h6>
                                                         </div>
                                                         <div itemprop="dateCreated" class="mkd-post-info-date entry-date updated">
                                                            <?= date("F d, Y", $news['creation_time'] / 1000); ?>
                                                            <meta itemprop="interactionCount" content="UserComments: 0" />
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <?php }
                                                      ?>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div>
            </div>
          </div>
          <!--  /.container  -->


        </div>
      </li>
      <li class="nav-item dropdown menu-item <?=($active_menu=='video'?'active':'')?>">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Videos <span class="fa fa-angle-down"></span>
        </a>
        <div class="dropdown-menu mkd-grid" aria-labelledby="navbarDropdown">


          <div class="mkd-grid">
            <div class="row">
               <div class="mkd-menu-second" style="padding: 0px 40px;">
          <div class="mkd-menu-inner mt-4">
             <ul>
                <li id="nav-menu-item-1680" class="menu-item menu-item-type-custom menu-item-object-custom ">
                   <div class="widget mkd-plw-six">
                      <div class="mkd-bnl-holder mkd-pl-six-holder  mkd-post-columns-5" data-base="mkd_post_layout_six" data-number_of_posts="5" data-column_number="5" data-post_in="493, 307, 211, 237, 382" data-thumb_image_size="custom_size" data-thumb_image_width="234" data-thumb_image_height="153" data-title_tag="h6" data-title_length="23" data-display_date="yes" data-display_category="yes" data-display_comments="no" data-display_share="no" data-display_excerpt="no" data-display_post_type_icon="yes" data-paged="1" data-max_pages="1">
                         <div class="mkd-bnl-outer">
                            <div class="mkd-bnl-inner">
                               <?php foreach ($video_list as $video) { ?>
                               <div class="mkd-pt-six-item mkd-post-item">
                                  <div class="mkd-pt-six-image-holder">
                                     <div class="mkd-post-info-category"><?= (!empty($video['author_name'])?$video['author_name']:'')?></div>
                                     <a itemprop="url" class="mkd-pt-six-slide-link mkd-image-link" href="<?= base_url('video/'.$video['id'])?>" target="_self">
                                     <img src="<?= $video['thumbnail_url']; ?>" alt="a" width="234" height="153" />
                                     <span class="mkd-post-info-icon-holder">
                                     <span class="mkd-post-info-icon mkd-post-video"></span>
                                     </span> 
                                     </a>
                                  </div>
                                  <div class="mkd-pt-six-content-holder">
                                     <div class="mkd-pt-six-title-holder">
                                        <h6 class="mkd-pt-six-title">
                                           <a itemprop="url" class="mkd-pt-link" href="<?= base_url('video/'.$video['id'])?>" target="_self"><?= $video['video_title']; ?></a>
                                        </h6>
                                     </div>
                                     <div itemprop="dateCreated" class="mkd-post-info-date entry-date updated">
                                        <?= date("F d, Y", $video['creation_time'] / 1000); ?>
                                        <meta itemprop="interactionCount" content="UserComments: 0" />
                                     </div>
                                  </div>
                               </div>
                               <?php }
                                  ?>
                            </div>
                         </div>
                      </div>
                   </div>
                </li>
             </ul>
          </div>
       </div>
            </div>
          </div>
          <!--  /.container  -->


        </div>
      </li>
      
      <li class="nav-item <?=($active_menu=='about_us'?'active':'')?>">
        <a class="nav-link" href="<?= base_url('about-us')?>" target="_self">About Us</a>
      </li>
      <li class="nav-item <?=($active_menu=='privacy_policy'?'active':'')?>">
        <a class="nav-link" href="<?= base_url('privacy-policy')?>" target="_self">Privacy Policy</a>
      </li>
      <li class="nav-item <?=($active_menu=='terms_conditions'?'active':'')?>">
        <a class="nav-link" href="<?= base_url('terms-conditions')?>" target="_self">Terms & Conditions</a>
      </li>
      <li class="nav-item <?=($active_menu=='contact_us'?'active':'')?>">
        <a class="nav-link" href="<?= base_url('contact-us')?>" target="_self">Contact Us</a>
      </li>
      

    </ul>
<!--    <form class="form-inline my-2 my-lg-0">
     <a class="mkd-header-cart" href="#">
      <i> <img src="<?= base_url('assets/website_assets/images/live-icon1.gif'); ?>" alt="live" height="30" width="100"/></i>
      </a>
    </form>-->
  </div>

</div>
</nav>
    </header>