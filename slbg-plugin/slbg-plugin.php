<?php
/**
 * Plugin Name: SLBG Plugin
 * Description: Test task for Solberg interview
 * Plugin URI:  https://github.com/AndreiBaradzin84/slbg_test_task
 * Author URI: 	https://github.com/AndreiBaradzin84/
 * Author:      Andrei Baradzin
 *
 * Requires PHP: 7.4
 *
 * Version:     1.0
 */

if (!class_exists('SLBGPlugin')) {

    class SLBGPlugin
    {

        const REQUIRED_PHP_VERSION = '7.4';

        public function __construct()
        {

            if ($this->check_php_compatibility()) {
                add_filter('the_title', [&$this, 'add_date']);
            }

        }

        public function check_php_compatibility(): bool
        {
            if (version_compare(PHP_VERSION, self::REQUIRED_PHP_VERSION, '<=')) {

                add_action('admin_init', [&$this, 'deactivate_plugin']);
                add_action('admin_notices', [&$this, 'display_php_alert']);

                return false;
            }

            return true;
        }

        public function deactivate_plugin(): void
        {
            deactivate_plugins(plugin_basename(__FILE__));
        }

        public function display_php_alert(): void
        {

            $message = 'Plugin deactivated because of non-compatible PHP version. Your PHP version is ' . PHP_VERSION .
                '. SLBGPlugin requires PHP version ' . self::REQUIRED_PHP_VERSION . ' or higher.';
            echo '<div class="notice notice-error is-dismissible"> <p>' . $message . '</p></div>';

        }

        public function add_date(string $title): string
        {
            return $title . ' ' . get_the_date();
        }

    }

    new SLBGPlugin();
}
