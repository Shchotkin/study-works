<?php
/** Загружаемые стили и скрипты **/

function load_style_scripts (){
	wp_enqueue_style( 'style', get_stylesheet_directory_uri().'/style.css');
	wp_enqueue_style( 'reset', get_stylesheet_directory_uri().'/stylesheets/reset.css');
	wp_enqueue_style( 'responsive', get_stylesheet_directory_uri().'/stylesheets/responsive.css');
	wp_enqueue_style( 'general', get_stylesheet_directory_uri().'/stylesheets/general.css');
	wp_enqueue_style( 'styleHeader', get_stylesheet_directory_uri().'/stylesheets/styleHeader.css');
	wp_enqueue_style( 'styleMain', get_stylesheet_directory_uri().'/stylesheets/styleMain.css');
	wp_enqueue_style( 'footer', get_stylesheet_directory_uri().'/stylesheets/footer.css');
};

/** Загружаем стили и скрипты **/

add_action( 'wp_enqueue_scripts', 'load_style_scripts');

/**
* Регистрация меню
**/

register_nav_menu( 'menu', 'Меню' );

/**
*Виджеты Сайдбар
**/

register_sidebar(array(
   'name'=>'Виджеты товарного бара',
   'id'=>'tovbar',

	));
/**
*Поддержка миниатюр
**/
add_theme_support( 'post-thumbnails' );

/*
* Добавляется поле - контактный e-mail
*/
/*
function custom_settings_contact_email (){

add_settings_section( 
	'contacts_sect', 
	'Контакты для вывовода на сайте', 
	'', 
	'general' );	

add_settings_field(
'custom_email',
'e-mail для обратной связи',
'display_custom_email',
'general'
 );

register_setting(
'general',
'contact_email'
 );
}

add_action( 'admin_init', 'custom_settings_contact_email' );
function display_custom_email (){
	echo "<input type='text' class='regular-text' name='contact_email' value='".esc_attr( get_option( 'contact_email' ) )."'>";
}*/

/*
* Блок товаров
*/
add_filter('post_type_link', 'merchandise_permalink', 1, 2);
function merchandise_permalink( $permalink, $post ){
	// выходим если это не наш тип записи: без холдера %products%
	if( strpos($permalink, '%merchant-category%') === false )
		return $permalink;

	// Получаем элементы таксы
	$terms = get_the_terms($post, 'merchant-category');
	// если есть элемент заменим холдер
	if( ! is_wp_error($terms) && !empty($terms) && is_object($terms[0]) )
		$term_slug = array_pop($terms)->slug;
	// элемента нет, а должен быть...
	else
		$term_slug = 'no-merchant-category';

	return str_replace('%merchant-category%', $term_slug, $permalink );
}

function merchandise_posts(){

	register_taxonomy('merchant-category', array('merchandise'), array(
		'label'                 => 'Category', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => _x( 'Виды товара', 'taxonomy general name' ),
			'singular_name'     => _x( 'Вид товара', 'taxonomy singular name' ),
			'search_items'      => __( 'Искать Вид товара' ),
			'all_items'         => __('Все Виды товара'),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:'),
			'edit_item'         => __('Ред. Вид товара'),
			'update_item'       => __('Обновить Вид товара'),
			'add_new_item'      => __('Добавить Вид товара'),
			'new_item_name'     => __('Новый Вид товара'),
			'menu_name'         => __('Вид товара')
		),
		'description'           => 'Рубрики для видов товара', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => true,
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_tagcloud'         => false, // равен аргументу show_ui
		'hierarchical'          => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' 			=> true,
		'rewrite'               => array('slug'=>'merchant-category', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
		'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
	) );

	// Добавляем НЕ древовидную таксономию 'writer' (как метки)
	register_taxonomy('merchantcat-mark', array('merchandise'), array(
		'description' => 'Метки для видов товара',
		'public' => true,
		'hierarchical' => false,
		'labels' => $labels_mark,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug'=>'merchantcat-mark', 'hierarchical'=>false, 'with_front'=>false, 'feed'=>false ),
	));

	$labels_mark = array(
		'name' => _x( 'Метки','taxonomy general name' ),
		'singular_name' => _x( 'Метка', 'taxonomy singular name' ),
		'search_items' =>  __( 'Искать метки' ),
		'popular_items' => __( 'Популярные метки' ),
		'all_items' => __( 'Все метки' ),
		'parent_item' => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item' => __( 'Редактировать метки' ),
		'update_item' => __( 'Обновить метки' ),
		'add_new_item' => __( 'Добавить новую метку' ),
		'new_item_name' => __( 'Название новой метки' ),
		'separate_items_with_commas' => __( 'Разделить метки запятыми' ),
		'add_or_remove_items' => __( 'Добавить или удалить метки' ),
		'choose_from_most_used' => __( 'Выбрать из наиболее часто используемых меток' ),
		'menu_name' => __( 'Метки' ),
	);


	$labels = array(  
		'name' => 'Товары', // Основное название типа записи  
		'singular_name' => 'Товар', // отдельное название записи типа Book  
		'add_new' => 'Добавить новый',  
		'add_new_item' => 'Добавить новый товар',  
		'edit_item' => 'Редактировать товар',  
		'new_item' => 'Новый товар',  
		'view_item' => 'Посмотреть товар',  
		'search_items' => 'Найти товар',  
		'not_found' =>  'товар не найден',  
		'not_found_in_trash' => 'В корзине товара не найдено',  
		'parent_item_colon' => '',  
		'menu_name' => 'Товары'  
	);  
	$args = array(  
		'labels' => $labels,  
		'public' => true,  
		'publicly_queryable' => true,  
		'show_ui' => true,
		'exclude_from_search'=> false, 
		'show_in_menu' => true,
		'show_in_nav_menus' => true,  
		'query_var' => true,  
		'rewrite' => array( 'slug'=>'merchandise/%merchantcat%', 'with_front'=>false, 'pages'=>false, 'feeds'=>false, 'feed'=>false ),
		'capability_type' => 'post',  
		'has_archive' => true,  
		'hierarchical' => false,  
		'menu_position' => null,  
		'supports' => array('title', 'author','thumbnail','editor','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
		/*'register_meta_box_cb' => '', */
		'taxonomies' => array( 'merchant-category', 'merchantcat-mark' )
	);  
	register_post_type('merchandise', $args);  
}
add_action('init', 'merchandise_posts');

/*
 * Plugin name: Contacts
 * Description: Демонстрация создания страницы настроек для плагина
*/

function contents_posts(){  
	$labels = array(  
		'name' => 'Содержание статичных страниц', // Основное название типа записи  
		'singular_name' => 'Содержание', // отдельное название записи типа Book  
		'add_new' => 'Добавить новый',  
		'add_new_item' => 'Добавить другой пост',  
		'edit_item' => 'Редактировать содержание',  
		'new_item' => 'Новый пост',  
		'view_item' => 'Посмотреть содержание',  
		'search_items' => 'Найти пост',  
		'not_found' =>  'Пост не найден',  
		'not_found_in_trash' => 'В корзине постА не найдено',  
		'parent_item_colon' => '',  
		'menu_name' => 'Пользовательский контент'  
	);  
	$args = array(  
		'labels' => $labels,  
		'public' => true,  
		'publicly_queryable' => true,  
		'show_ui' => true,  
		'show_in_menu' => true,  
		'query_var' => true,  
		'rewrite' => true,  
		'capability_type' => 'post',  
		'has_archive' => true,  
		'hierarchical' => false,  
		'menu_position' => null,  
		'supports' => array('title', 'author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats')  
	);  
	register_post_type('contents', $args);  
}
add_action('init', 'contents_posts');



// подключаем функцию активации мета блока (my_extra_fields)
add_action('add_meta_boxes', 'my_extra_fields', 1);

function my_extra_fields() {
	add_meta_box( 'extra_fields', 'Дополнительные поля', 'extra_fields_box_func', 'post', 'normal', 'high'  );
}

// код блока
function extra_fields_box_func( $post ){
	?>
	<p><label><input type="text" name="extra[title]" value="<?php echo get_post_meta($post->ID, 'title', 1); ?>" style="width:50%" /> ? заголовок страницы (title)</label></p>

	<p>Описание статьи (description):
		<textarea type="text" name="extra[description]" style="width:100%;height:50px;"><?php echo get_post_meta($post->ID, 'description', 1); ?></textarea>
	</p>

	<p>Видимость поста: <?php $mark_v = get_post_meta($post->ID, 'robotmeta', 1); ?>
		 <label><input type="radio" name="extra[robotmeta]" value="" <?php checked( $mark_v, '' ); ?> /> index,follow</label>
		 <label><input type="radio" name="extra[robotmeta]" value="nofollow" <?php checked( $mark_v, 'nofollow' ); ?> /> nofollow</label>
		 <label><input type="radio" name="extra[robotmeta]" value="noindex" <?php checked( $mark_v, 'noindex' ); ?> /> noindex</label>
		 <label><input type="radio" name="extra[robotmeta]" value="noindex,nofollow" <?php checked( $mark_v, 'noindex,nofollow' ); ?> /> noindex,nofollow</label>
	</p>

	<p><select name="extra[select]" />
			<?php $sel_v = get_post_meta($post->ID, 'select', 1); ?>
			<option value="0">----</option>
			<option value="1" <?php selected( $sel_v, '1' )?> >Выбери меня</option>
			<option value="2" <?php selected( $sel_v, '2' )?> >Нет, меня</option>
			<option value="3" <?php selected( $sel_v, '3' )?> >Лучше меня</option>
		</select> ? выбор за вами</p>

	<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
	<?php
}

// включаем обновление полей при сохранении
add_action('save_post', 'my_extra_fields_update', 0);

/* Сохраняем данные, при сохранении поста */
function my_extra_fields_update( $post_id ){
	if ( !isset($_POST['extra_fields_nonce']) || !wp_verify_nonce($_POST['extra_fields_nonce'], __FILE__) ) return false; // проверка
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // если это автосохранение
	if ( !current_user_can('edit_post', $post_id) ) return false; // если юзер не имеет право редактировать запись

	if( !isset($_POST['extra']) ) return false; 

	// Все ОК! Теперь, нужно сохранить/удалить данные
	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) ){
			delete_post_meta($post_id, $key); // удаляем поле если значение пустое
			continue;
		}

		update_post_meta($post_id, $key, $value); // add_post_meta() работает автоматически
	}
	return $post_id;
}

?>