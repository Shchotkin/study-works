<?php/*
Template Name: home
*/?>
<?php get_header(); ?>

<main>
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
</main>
<?php get_footer(); ?>