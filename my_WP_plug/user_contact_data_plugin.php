<?php
/**
 * @package SEO_menu_page
 * @version 1.0
 */
/*
Plugin Name: User_contact_data_menu_page
Plugin URI: 
Description: This is the my second simple plugin. 
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
/*
* Меню - Мои настройки
*/

add_action('admin_menu', 'registr_my_menu_page');

	function registr_my_menu_page(){
	add_menu_page( '', 'Мои настройки', 'manage_options', 'site-option', 'add_my_setting', '', 4 );
	  
} 

// функция отвечает за вывод страницы настроек
// подробнее смотрите API Настроек: http://wp-kama.ru/id_3773/api-optsiy-nastroek.html
function add_my_setting(){
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<?php
		// settings_errors() не срабатывает автоматом на страницах отличных от опций
		if( get_current_screen()->parent_base !== 'options-general' )
			settings_errors('название_опции');
		?>
		<?php 
			echo '<p><b>Воспользуйтесь подменю данного меню для ввода, редактирования, удаления вашего контента. </b></p>
						<p>Всё введённая здесь информация будет отображена и стилизована в соответсвующих разделах сайта. </p>
						<p>Создано для удобства ведения сайта. </p>
				</br>
			';
		?>
	<	<form action="options.php" method="POST">
		<?php wp_nonce_field('update-options'); ?>
			<?php
				settings_fields("site-options");     // скрытые защитные поля
				do_settings_sections("site-options"); // секции с настройками (опциями).
				//submit_button();
			?>
		</form>
	</div>
	<?php
}

add_action('admin_menu', 'register_adrees_submenu_page');

function register_adrees_submenu_page() {
	add_submenu_page( 'site-option', 'Контактные данные для вывода на сайте', 'Почтовые адреса', 'manage_options', 'adress-site-options', 'adress_site_options_submenu_page_callback' ); 
}

function adress_site_options_submenu_page_callback() {
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<form action="options.php" method="POST">
			<?php wp_nonce_field('update-options'); ?>
			<?php
				settings_fields( 'adress-site-options' );     // скрытые защитные поля
				do_settings_sections( 'adress-site-options' ); // секции с настройками (опциями). У нас она всего одна 'section_id'
				submit_button();
			?>
		</form>
	</div>
	<?php
}


add_action( 'admin_init', 'adress_settings_api_init' );
function adress_settings_api_init() {
	// Добавляем блок опций на базовую страницу "Чтение"
	add_settings_section(
		'adress_setting_section', // секция
		'Адреса для вывода на сайте.',
		'',
		'adress-site-options' // страница
	);

	// Добавляем поля опций. Указываем название, описание, 
	// функцию выводящую html код поля опции.

	add_settings_field(
		'post_adress',
		'Почтовый адрес',
		'post_adress_setting_callback_function2', // можно указать ''
		'adress-site-options', // страница
		'adress_setting_section' // секция
	);

	add_settings_field(
		'low_adress',
		'Юридический адрес',
		'low_adress_setting_callback_function2', // можно указать ''
		'adress-site-options', // страница
		'adress_setting_section' // секция
	);

	add_settings_field(
		'another_adress',
		'Другой адрес',
		'another_adress_setting_callback_function2', // можно указать ''
		'adress-site-options', // страница
		'adress_setting_section' // секция
	);

	add_settings_field(
		'email_adress',
		'Email',
		'email_adress_setting_callback_function2',
		'adress-site-options', // страница
		'adress_setting_section' // секция
	);
	
	// Регистрируем опции, чтобы они сохранялись при отправке 
	// $_POST параметров и чтобы callback функции опций выводили их значение.

	register_setting( 'adress-site-options', 'post_adress' );
	register_setting( 'adress-site-options', 'low_adress' );
	register_setting( 'adress-site-options', 'another_adress' );
	register_setting( 'adress-site-options', 'email_adress' );
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


function post_adress_setting_callback_function2() {
	echo '<input type="text" 
			style="width:800px"
			class="regular-text"
			name="post_adress"
			value='.esc_attr( get_option( 'post_adress' ) ).'>';
}

function low_adress_setting_callback_function2() {
	echo '<input type="text" 
			style="width:800px"
			class="regular-text"
			name="low_adress"
			value='.esc_attr( get_option( 'low_adress' ) ).'>
			';
}

function another_adress_setting_callback_function2() {
	echo '<input type="text"
			style="width:800px"
			class="regular-text"
			name="another_adress"
			value='.esc_attr( get_option( 'another_adress' ) ).'>'
			;
}

function email_adress_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="email_adress"
			value='.esc_attr( get_option( 'email_adress' ) ).'>';
}

/*
* Подменю - Телефоны
*/

add_action('admin_menu', 'register_phones_submenu_page');

function register_phones_submenu_page() {
	add_submenu_page( 'site-option', 'Контактные данные для вывода на сайте', 'Телефоны', 'manage_options', 'phone-site-options', 'phones_site_options_submenu_page_callback' ); 
}

function phones_site_options_submenu_page_callback() {
	?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<form action="options.php" method="POST">
			<?php wp_nonce_field('update-options'); ?>
			<?php
				settings_fields( 'phone-site-options' );     // скрытые защитные поля
				do_settings_sections( 'phone-site-options' ); // секции с настройками (опциями). У нас она всего одна 'section_id'
				submit_button();
			?>
		</form>
	</div>
	<?php
}

add_action( 'admin_init', 'phone_settings_api_init' );
function phone_settings_api_init() {
	// Добавляем блок опций на базовую страницу "Чтение"
	add_settings_section(
		'phone_setting_section', // секция
		'Телефоны для вывода на сайте.',
		'',
		'phone-site-options' // страница
	);

	// Добавляем поля опций. Указываем название, описание, 
	// функцию выводящую html код поля опции.

	add_settings_field(
		'phone_number1',
		'Телефон №1',
		'phone1_setting_callback_function2',
		'phone-site-options', // страница
		'phone_setting_section' // секция
	);

	add_settings_field(
		'phone_number2',
		'Телефон №2',
		'phone2_setting_callback_function2',
		'phone-site-options', // страница
		'phone_setting_section' // секция
	);

	// Регистрируем опции, чтобы они сохранялись при отправке 
	// $_POST параметров и чтобы callback функции опций выводили их значение.

	register_setting( 'phone-site-options', 'phone_number1' );
	register_setting( 'phone-site-options', 'phone_number2' );
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


function phone1_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="phone_number1"
			value='.esc_attr( get_option( 'phone_number1' ) ).'>';
}

function phone2_setting_callback_function2() {
	echo '<input type="text" 
			class="regular-text"
			name="phone_number2"
			value='.esc_attr( get_option( 'phone_number2' ) ).'>
			';
}
?>
