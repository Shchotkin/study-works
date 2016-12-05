<?php/*
Template Name: sell
*/?>
<?php get_header(); ?>
        <section class="sellPart">
          <div class="container">
             <div class="row">
<ul>
   <?php wp_list_categories('taxonomy=merchant-category'); ?>
</ul>

<?php
echo '--------------------------------------';   
$terms = get_terms("merchant-category");
 $count = count($terms);
 if($count > 0){
   echo "<ul>";
   foreach ($terms as $term) {
     echo "<li>".$term->name."</li>";

   }
   echo "</ul>";
 } ?>

 <?php
// список разделов произвольной таксономии genre
echo '--------------------------------------';   

$args = array(
  'taxonomy'     => 'merchant-category', // название таксономии
  'orderby'      => 'name',  // сортируем по названиям
  'show_count'   => 0,       // не показываем количество записей
  'pad_counts'   => 0,       // не показываем количество записей у родителей
  'hierarchical' => 1,       // древовидное представление
  'title_li'     => '',      // список без заголовка
  'child_of'      => 15 
);
?>

<ul>
<?php wp_list_categories( $args ); ?>
</ul>


    
              <!--  
              <div class="cols col-12">
                  <h1 class="titlSellPanet">Мёд</h1>
                </div>
              </div>
              <div class="row">
                 <div class="cols col-1"></div>
                  <div class="cols col-2">
                    <img src="img/dark1.png"  alt="dark" class="sellImg">  
                      <label class="labelSwocase">
                          <input type="checkbox" class="switch"></br>Тёмные мёда
                      </label>
                      </div>
                  <div class="cols col-2">
                      <img src="img/miks1.png" alt=""  class="sellImg">
                       <label class="labelSwocase">
                           <input type="checkbox" class="switch"></br>Смешанные сорта мёда
                      </label>
                  </div>
                  <div class="cols col-2">
                      <img src="img/light.png" alt=""class="sellImg">
                       <label class="labelSwocase">
                           <input type="checkbox" class="switch"></br>Светлые мёда
                      </label>
                  </div>
                  <div class="cols col-2">
                      <label class="labelSwocase">
                        <img src="img/white2.png" alt=""class="sellImg"><input type="checkbox" class="switch"></br>Липовый / белый мёд
                      </label>
                  </div>
                  <div class="cols col-2">
                     <img src="img/prodHoney1.png" alt="" class="sellImg">
                      <label class="labelSwocase" for="">
                          <input type="checkbox" class="switch"></br>Продукты пчеловодства
                      </label>
                  </div>
                <div class="cols col-1"></div>
              </div>
              <!--<div class="store">-->
               <!--   <div class="row">
                      <div class="cols col-4">
                          <div class="product">
                              <img src="img/raw-miel.jpg" alt="" style="width:40%;">
                              <p class="price">
                                За 1 литр 70 грн.
                              </p>
                              <input class="buy" type="button" name="buttom" value="Купить"><label for="buttom"></label>
                          </div>
                      </div>
                      <div class="cols col-4">
                          <div class="product">
                              <img src="img/raw-miel.jpg" alt="" style="width:40%;">
                              <p class="price">
                                За 1 литр 70 грн.
                              </p>
                              <input class="buy" type="button" name="buttom" value="Купить">
                          </div>
                      </div>
                      <div class="cols col-4">
                          <div class="product">
                              <img src="img/raw-miel.jpg" alt="" style="width:40%;">
                              <p class="price">
                                За 1 литр 70 грн.
                              </p>
                              <input class="buy" type="button" name="buttom" value="Купить">
                          </div><!--end producr-->
                      </div><!--end col-->
                   </div><!-- end row -->
             <!-- </div><!-- end store -->
            </div><!--end container-->          
        </section>
<?php get_footer(); ?>