<?php/*
Template Name: about
*/?>
<?php get_header(); ?>
	<section class="about">
           <div class="container">
              <div class="row">
                  <div class="cols col-12">
                      <h1 class="titleArtical"><?php the_title(); ?></h1>
                  </div>
              </div>
                <div class="row">
                 <div class="cols col-12">
                    <article class="paseka">
                      <div class="row ">
                          <div class="cols col-12">
                              
                        <?php       
                         $id = 30; // номер категории
						 $posts_about = new WP_Query(array('category_name' => 'О пасечнике' , 'posts_per_page' => 2, 'order' => 'ASC'));
						?>
              
                       	<?php if ( $posts_about-> have_posts()) :  while ($posts_about->have_posts()) : $posts_about->the_post(); ?>

							<p>
								<h3><?php the_title(); ?></h3>
								<img class="pImg1" src="http://lorempixel.com/400/200" />
								<?php the_content(); ?>

							</p>

							<?php endwhile; ?>
							<?php else : ?>
								<p>Заполните этот раздел</p>
							<?php endif; ?>
						   
                          </div><!--end col-12 <p> in article -->
                      </div><!--end row <p> in article-->
                     </article>
                    </div><!--end col-12 - wrapper artical-->
                  </div><!--end row - wrapper artical-->
                  <div class="row">
                    <div class="gallery">
                        <div class="cols col-4">
                            <img class="pImg2" src="http://lorempixel.com/400/200" />
                        </div>
                        <div class="cols col-4">
                            <img class="pImg2" src="http://lorempixel.com/400/200" />
                        </div>
                        <div class="cols col-4">
                            <img class="pImg2" src="http://lorempixel.com/400/200" />
                        </div>
                     </div><!--end gallery-->
                    </div><!--end row gallery-->
                    <div class="row">
                       <div class="cols col-2"></div>
                       <div class="cols col-4">
                       <p>
                       Задайте мне Ваш вопрос:
                       </p>
                       </div>
                       <div class="cols col-6"></div>
                   </div>
                   <div class="row">
                       <div class="cols col-1"></div>
                       <div class="cols col-8">
                           <form name="" method="" action="" class="comments">
                               <textarea name="comment" cols="80" rows="10"></textarea>
                               <input type="submit" value="Отправить">
                               <input type="reset" value="Очистить">
                            </form>
                       </div>
                       <div class="cols col-3"></div>
                   </div>
                 
                  </div><!--end container artical-->
        </section>
       
<?php get_footer(); ?>