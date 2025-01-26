<?php
/**
 * Plugin Name: Subscription Form
 * Plugin URI:
 * Description: Display a subscription form.
 * Version: 1.0
 * Author: Aidan Wickes
 * Author URI: 
 */

 add_filter('content', 'subscription_form');
 function subscription_form($content) {
    if(!is_singular()) {
        return $content;
    }

    wp_enqueue_script('sub-style');

    $nonce_field = wp_nonce_field('subscribe', 'sub_nonce', true, false);

    if(!empty($_GET['sub_success'])) {
        $sub_display.= '<p class="sub-success">Thanks for subscribing!</p>';
    } else {
        $sub_display = '
        <h4>Subscribe to our updates!</h4>
        <form id="sub-form" action="' . admin_url('admin-post.php') . '" method="post">
            <input type="email" name="sub_email" placeholder="Email Address" required>
            ' . $nonce_field . '
            <input type="hidden" name="action" value="subscribe">
            <input type="submit" value="Subscribe">
        </form>';
    }
    return $content . $sub_display;
 }

 add_action('wp_enqueue_scripts', 'sub_assets');
 function sub_assets() {
    wp_register_style('sub-style', plugin_dir_url(__FILE__) . 'sub-styles.css');
 }

 add_action('wp_post_sub_form_submit', 'sub_form_submit');
 add_action('wp_post_nopriv_sub_form_submit', 'sub_form_submit');

 function sub_form_submit() {
    if(!empty($_POST['name']) || !isset($_POST['sub_nonce']) || !wp_verify_nonce($_POST['sub_nonce'], 'sub_form_submit')) {
        die();
        return;
    }

    wp_remote_post('https://api.example.com/subscribe/members', array(
        'headers' => array(
            'Authorization' => 'Basic ' . base64_encode( 'mywebsite' . ':' . 'cd64539dd19283cdcc637f2ccddcd45-us6'),
            'Content-Type' => 'application/json'
        ),
        'body' => json_encode(array(
            'email' => $_POST['sub_email'],
            'status' => 'subscribed'
        ))
    ));

    $url = add_query_arg('sub_success', '1', $_SERVER['HTTP_REFERER']);
    wp_redirect($url);

    die();
 }  