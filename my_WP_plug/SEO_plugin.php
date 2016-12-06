<?php
/**
 * @package SEO_menu_page
 * @version 1.0
 */
/*
Plugin Name: SEO_menu_page
Plugin URI: 
Description: This is the my first simple plugin. 
Author: Andrii Shchotkin
Version: 1.0
Author URI: 
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/
add_action('admin_menu', 'registr_SEO_menu_page');

	function registr_SEO_menu_page(){
	add_menu_page( '', 'Раздел SEO', 'manage_options', 'seo-site-options', 'add_seo_setting', '', 5 );
	add_submenu_page( 'seo-option', 'Раздел SEO', 'Слова поисковой оптимизации', 'manage_options', 'seo-site-options', 'add_seo_setting', '', 5 );
	
} 

function add_seo_setting(){
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<?php
		// settings_errors() не срабатывает автоматом на страницах отличных от опций
		if( get_current_screen()->parent_base !== 'options-general' )
			settings_errors('название_опции');
		?>
		<form action="options.php" method="POST">
		<?php wp_nonce_field('update-options'); ?>
			<?php
				settings_fields( 'seo-site-options' );
				do_settings_sections( 'seo-site-options' ); 
				submit_button();
			?>
		</form>
	</div>
	<?php
}

add_action( 'admin_init', 'seo_settings_api_init' );
function seo_settings_api_init() {
	
	add_settings_section(
		'seo_setting_section', // секция
		'Ввод слов поисковой оптимизации сайта.',
		'',
		'seo-site-options' // страница
	);

	add_settings_section(
		'page_social_setting_section', // секция
		'Странички в социальных сетях для вывода на сайте.',
		'',
		'seo-site-options' // страница
	);

	add_settings_field(
		'seo-word-options',
		'Слова для поисковой оптимизации',
		'seo_setting_callback_function2',
		'seo-site-options', // страница
		'seo_setting_section' // секция
	);

	add_settings_field(
		'page_social_facebook',
		'Страничка в социальных сетях_facebook',
		'facebook_page_setting_callback_function2',
		'seo-site-options', // страница
		'page_social_setting_section' // секция
	);

	add_settings_field(
		'page_social_vkontakte',
		'Страничка в социальных сетях_vkontakte',
		'vkontakte_page_setting_callback_function2',
		'seo-site-options', // страница
		'page_social_setting_section' // секция
	);

	add_settings_field(
		'page_social_odnoklassniki',
		'Страничка в социальных сетях_odnoklassniki',
		'odnoklassniki_page_setting_callback_function2',
		'seo-site-options', // страница
		'page_social_setting_section' // секция
	);

	add_settings_field(
		'page_social_google',
		'Страничка в социальных сетях_google',
		'google_page_setting_callback_function2',
		'seo-site-options', // страница
		'page_social_setting_section' // секция
	);

	add_settings_field(
		'page_social_youTube',
		'Страничка в социальных сетях_youTube',
		'youTube_page_setting_callback_function2',
		'seo-site-options', // страница
		'page_social_setting_section' // секция
	);

	register_setting( 'seo-site-options', 'seo-word-options' );
	register_setting( 'seo-site-options', 'page_social_facebook' );
	register_setting( 'seo-site-options', 'page_social_vkontakte' );
	register_setting( 'seo-site-options', 'page_social_odnoklassniki' );
	register_setting( 'seo-site-options', 'page_social_google' );
	register_setting( 'seo-site-options', 'page_social_youTube' );
}

	function seo_setting_callback_function2() {
		echo '<input type="text"
				style="width:500px"
				class="regular-text"
				name="seo-word-options"
				value='.esc_attr( get_option( 'seo-word-options' ) ).'>';
	}

// ------------------------------------------------------------------
// Сallback функция для секции
// ------------------------------------------------------------------
//
// Функция срабатывает в начале секции, если не нужно вывдить 
// никакой текст или делать что-то еще до того как выводить опции, 
// то функцию можно не использовать для этого укажите '' в третьем 
// параметре add_settings_section
//
/*function contact_setting_section_callback_function() {
	echo '<p>Секция для ввода контактных данных, выводимых на сайте</p>';
}*/

// ------------------------------------------------------------------
// Callback функции выводящие HTML код опций
// ------------------------------------------------------------------
//
// Создаем checkbox и text input теги
//


function facebook_page_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="page_social_facebook"
			value='.esc_attr( get_option( 'page_social_facebook' ) ).'>';
}

function vkontakte_page_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="page_social_vkontakte"
			value='.esc_attr( get_option( 'page_social_vkontakte' ) ).'>
			';
}

function odnoklassniki_page_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="page_social_odnoklassniki"
			value='.esc_attr( get_option( 'page_social_odnoklassniki' ) ).'>
			';
}

function google_page_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="page_social_google"
			value='.esc_attr( get_option( 'page_social_google' ) ).'>
			';
}

function youTube_page_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="page_social_youTube"
			value='.esc_attr( get_option( 'page_social_youTube' ) ).'>
			';
}


/*
* Подменю - Странички в социальных сетях


add_action('admin_menu', 'register_socialNetworPages_submenu_page');

function register_socialNetworPages_submenu_page() {
	add_submenu_page( 'site-option', 'Контактные данные для вывода на сайте', 'Странички в соц сетях', 'manage_options', 'contacts-site-options', 'socialNetworPages_site_options_submenu_page_callback' ); 
}

function socialNetworPages_site_options_submenu_page_callback() {
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<form action="options.php" method="POST">
			<?php wp_nonce_field('update-options'); ?>
			<?php
				settings_fields( 'socialNetworPages-site-options' );     // скрытые защитные поля
				do_settings_sections( 'socialNetworPages-site-options' ); // секции с настройками (опциями). У нас она всего одна 'section_id'
				submit_button();
			?>
		</form>
	</div>
	<?php
}


add_action( 'admin_init', 'social_settings_api_init' );
function social_settings_api_init() {
	// Добавляем блок опций на базовую страницу "Чтение"
	add_settings_section(
		'page_social_setting_section', // секция
		'Странички в социальных сетях для вывода на сайте.',
		'',
		'socialNetworPages-site-options' // страница
	);

	// Добавляем поля опций. Указываем название, описание, 
	// функцию выводящую html код поля опции.

	add_settings_field(
		'page_social_facebook',
		'Страничка в социальных сетях_facebook',
		'facebook_page_setting_callback_function2',
		'socialNetworPages-site-options', // страница
		'page_social_setting_section' // секция
	);

	add_settings_field(
		'page_social_vkontakte',
		'Страничка в социальных сетях_vkontakte',
		'vkontakte_page_setting_callback_function2',
		'socialNetworPages-site-options', // страница
		'page_social_setting_section' // секция
	);

	add_settings_field(
		'page_social_odnoklassniki',
		'Страничка в социальных сетях_odnoklassniki',
		'odnoklassniki_page_setting_callback_function2',
		'socialNetworPages-site-options', // страница
		'page_social_setting_section' // секция
	);

	add_settings_field(
		'page_social_google',
		'Страничка в социальных сетях_google',
		'google_page_setting_callback_function2',
		'socialNetworPages-site-options', // страница
		'page_social_setting_section' // секция
	);

	add_settings_field(
		'page_social_youTube',
		'Страничка в социальных сетях_youTube',
		'youTube_page_setting_callback_function2',
		'socialNetworPages-site-options', // страница
		'page_social_setting_section' // секция
	);

	// Регистрируем опции, чтобы они сохранялись при отправке 
	// $_POST параметров и чтобы callback функции опций выводили их значение.

	register_setting( 'socialNetworPages-site-options', 'page_social_facebook' );
	register_setting( 'socialNetworPages-site-options', 'page_social_vkontakte' );
	register_setting( 'socialNetworPages-site-options', 'page_social_odnoklassniki' );
	register_setting( 'socialNetworPages-site-options', 'page_social_google' );
	register_setting( 'socialNetworPages-site-options', 'page_social_youTube' );
}

// ------------------------------------------------------------------
// Сallback функция для секции
// ------------------------------------------------------------------
//
// Функция срабатывает в начале секции, если не нужно вывдить 
// никакой текст или делать что-то еще до того как выводить опции, 
// то функцию можно не использовать для этого укажите '' в третьем 
// параметре add_settings_section
//
/*function contact_setting_section_callback_function() {
	echo '<p>Секция для ввода контактных данных, выводимых на сайте</p>';
}*/

// ------------------------------------------------------------------
// Callback функции выводящие HTML код опций
// ------------------------------------------------------------------
//
// Создаем checkbox и text input теги
//

/*
function facebook_page_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="page_social_facebook"
			value='.esc_attr( get_option( 'page_social_facebook' ) ).'>';
}

function vkontakte_page_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="page_social_vkontakte"
			value='.esc_attr( get_option( 'page_social_vkontakte' ) ).'>
			';
}

function odnoklassniki_page_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="page_social_odnoklassniki"
			value='.esc_attr( get_option( 'page_social_odnoklassniki' ) ).'>
			';
}

function google_page_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="page_social_google"
			value='.esc_attr( get_option( 'page_social_google' ) ).'>
			';
}

function youTube_page_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="page_social_youTube"
			value='.esc_attr( get_option( 'page_social_youTube' ) ).'>
			';
}*/
?>
