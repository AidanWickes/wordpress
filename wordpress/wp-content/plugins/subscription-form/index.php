<?php
/**
 * Plugin Name: Subscription Form
 * Plugin URI:
 * Description: Display a subscription form.
 * Version: 1.0
 * Author: Aidan Wickes
 * Author URI: 
 */

$config = array(
    'provider' => 'mailchimp',
    'providers'=> array(
        'mailchimp' => array(
            'api_key' => 'cd64539dd19283cdcc637f2ccddcd45-us6'
        ),
        'sendgrid' => array(
            'api_key' => 'SG.5c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z6'
        )
    )
)

class SubscriptionForm {
    var $providers;
    var $provider;

    function __construct($config) {
        $this->providers = $config['providers'];
        $this->provider = $config['provider'];

        add_filter('content', array($this, 'subscription_form'));
        add_action('wp_enqueue_scripts', array($this, 'assets'));
        add_action('wp_ajax_subscribe', array($this, 'submissionHandler'));
        add_action('wp_ajax_nopriv_subscribe', array($this, 'submissionHandler'));
    }

    function form($content){
        if(!is_singular()){
            return $content;
        }

        wp_enqueue_style('sub-style');
        $nonce_field = wp_nonce_field('sub_form_submit', 'sub_nonce', true, false);

        if(!empty($_GET['sub_success'])){
            $sub_display = '<p class="sub-success">Thanks for subscribing!</p>';
        } else {

            $defaults = array(
                'email' => '<input type="email" name="sub_email" placeholder="Email Address" required>'
            );

            $sub_fields = apply_filters('sub/form_fields', $defaults);

            $sub_display = '
            <h4>Subscribe to our updates!</h4>
            <form id="sub-form" action="' . admin_url('admin-post.php') . '" method="post">
                ' . implode("", $sub_fields) . '
                <input type="submit" value="Subscribe">
                <input type="hidden" name="action" value="subscribe">
                ' . $nonce_field . '
            </form>';
    }
    return $content . $sub_display;
}

function assets() {
    wp_register_style('sub-style', plugin_dir_url(__FILE__) . 'sub-styles.css');
}

function mailchimpHandler() {
    if(!empty($_POST['name']) || !isset($_POST['sub_nonce']) || !wp_verify_nonce($_POST['sub_nonce'], 'sub_form_submit')) {
        die();
        return;
    }

    wp_remote_post('https://api.example.com/subscribe/members', array(
        'headers' => array(
            'Authorization' => 'Basic ' . base64_encode( 'mywebsite' . ':' . $this->providers['mailchimp']['api_key']),
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

function submissionHandler() {
    if(method_exists($this, $this->provider . 'Handler')) {
        call_user_func(array($this, $this->provider . 'Handler'));
    } else {
        echo $this->provider . ' Handler not found';
    }
}

}

new SubscriptionForm($config);