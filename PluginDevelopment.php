<?php
/*
 * Plugin Name:       Plugin Development
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       plugin-development
 * Domain Path:       /languages
 * Requires Plugins:
 */

if(!defined('ABSPATH')){
    exit;
}

/**
 *  The Main Plugin Class
 */
class PluginDevelopment{
    /**
     * Plugin Version
     */

    const VERSION = '1.0';


    /**
     * Class constructor
     */
    private function __construct(){
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);

        add_action('plugins_loaded', [$this, 'init_plugins']);


    }



    /**
     * Initializes a singleton instance
     * @return \PluginDevelopment
     */
    public static function init(){
        static $instance = false;
        if(! $instance ){
            $instance = new self();
        }
    return $instance;
    }

    /**
     * define the required plugin constants
     * @return void
     */
    public function define_constants(){
        define('PLUGIN_DEVELOPMENT_VERSION', self::VERSION);
        define('PLUGIN_DEVELOPMENT_FILE', __FILE__);
        define('PLUGIN_DEVELOPMENT_PATH', __DIR__);
        define('PLUGIN_DEVELOPMENT_URL', plugin_url('', PLUGIN_DEVELOPMENT_FILE));
        define('PLUGIN_DEVELOPMENT_ASSETS', PLUGIN_DEVELOPMENT_URL . '/assets' );

    }

    /**
     * Initialize Plugin
     * @return void
     */
    public function init_plugins(){

    }

    /**
     * do stuff upon plugin activation
     * @return void
     */
    public function activate(){
        $installed = get_option('hr_academy_installed');
        if(! $installed){
            update_option('hr_academy_installed', time());
        }

        update_option('hr_academy_version', PLUGIN_DEVELOPMENT_VERSION);
    }




}

/**
 * Initializes the main plugin
 * @return \PluginDevelopment
 */
function PluginDevelopment(){
    return PluginDevelopment::init();
}

//kick-off the plugin
PluginDevelopment();