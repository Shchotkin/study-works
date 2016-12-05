  <?php get_header(); ?>
 <!-- <main>
        <section class="mainPage">
          <div class="container">
           <div class="row">
                <div class="cols col-12">
                    <div class="title">Мёд</div>
                </div>
            </div> 
               <div class="row">
                   <div class="cols col-12">
                        <p class="callToAction anime">
                        Перейти к заказам
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="cols col-12">
                       <div class="arrHov">
                           <a href="#action">
                         <img src="<?php echo bloginfo('template_url');?>/img/kdevelop_down.png" alt="Сделать заказ" class="arrowIcon">
                        </a>
                       </div>
                    </div>
                </div>    
          </div>
        </section>
  <section class="sellPart">
          <div class="container">
             <div class="row">
                 <div class="cols col-12">
                  <h3 class="titlSellPanet">Мёд</h3>
                  </div>
              </div>
              <div class="row">
                 <div class="cols col-1"></div>
  <?php if(have_posts()): while(have_posts()): the_post();?>
  <div class="cols col-2">  
    <?php the_post_thumbnail( 'full', 'class=sellImg' );?>
        <label class="labelSwocase">
            <input type="checkbox" class="switch"></br><?php the_title();?>
        </label>
  </div>                  
  <?php endwhile; // end of the loop. ?>
  <?php else: ?>
  <?php endif; ?>
          <div class="cols col-1"></div>
        </div>
      </div>
    </section>-->
   </main> 
  <?php get_footer(); ?>