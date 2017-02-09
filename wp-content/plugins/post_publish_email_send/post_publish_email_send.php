<?php
/*
Plugin Name: post-publish-email-send 
Plugin URI: 
Description: Плагін відправляє імейл повідомлення при збереженні поста
Version: 1.0
Author: Anatoly Skidkin
Author URI: 
License: GPL2
*/

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : EMAIl автора плагина)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


function post_publish_email_send($post_ID)
{
    $to = 'askidkin@yahoo.com';  //EMAIL отримувача
    $subject = 'У нас новий пост'; //Тема листа
    $message = 'У нас новий запис блогу на сайті. Запис має id='.$post_ID; //Контент листа з вказанням ID поста
    wp_mail($to, $subject, $message);
    return $post_ID;
}
add_action('publish_post', 'post_publish_email_send');
?>