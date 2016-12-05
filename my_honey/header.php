
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="andriishch">
    <link rel="shortcut icon" href="icon.ico" type="image/ico">
    <title><?php bloginfo(); wp_title();?></title>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Philosopher" rel="stylesheet">
    
    
    <!-- Вставка HTML5 поєднується з Respond.js для підтримки в IE8 елементів HTML5 та медіа-запитів -->
    <!-- ЗАСТЕРЕЖЕННЯ: файл Respond.js не працює, якщо ви проглядаєте сторінку відкривши її з файлової системи -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <?php wp_head();?>  
</head>
<body>
    <header>
       <div class="container">
            <div class="row">
              <div class="cols col-3">
                 <p class="title1">
                   Живи здоровО !
                   </p>
               </div> 
               <div class="cols col-1">
                   <img class="logoImg" src="<?php echo bloginfo('template_url');?>/img/logo2.png" alt="logo">
               </div>
               <div class="cols col-1"></div>
               <div class="cols col-1">
                   <img class="logoImg" src="<?php echo bloginfo('template_url');?> /img/gorshik.png" alt="">
               </div>
                <div class="cols col-1"></div>  
               <div class="cols col-4"><?php wp_nav_menu( array('theme_location'=>'menu', 'container'=> false));?></div>      
                <div class="cols col-1">
                  <div class="bag"></div>
				        <!--  <?php echo bloginfo('template_url');?>/img/Black_Cart%20(1).png" alt=""> -->
                </div>
            </div>
        </div>
    </header>