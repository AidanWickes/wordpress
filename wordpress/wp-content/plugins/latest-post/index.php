<?php
/**
 * Plugin Name: Latest Post
 * Plugin URI:
 * Description: Display the latest published post.
 * Version: 1.0
 * Author: Aidan Wickes
 * Author URI: 
 */

    add_shortcode('latest_post', 'latest_post_shortcode');

    function latest_post_shortcode() {
        if (false === ($latest_post = get_transient('latest_post'))){
            $latest_post = get_posts()[0];
            set_transient('latest_post', $latest_post, WEEK_IN_SECONDS);
        }

        return $latest_post->post_title;
    }

    add_action('save_post', 'latest_post_clear_cache');

    function latest_post_clear_cache() {
        delete_transient('latest_post');
    }