<?php

/*
 * WORDSMITH SETTINGS PAGE CLASS
 * 
 * this class is the base object for a post type to be added into wordpress.
 * 
 */

namespace nk2580\wordsmith\SettingsPages;

class SettingsPage {

    protected $page_title;
    protected $menu_title;
    protected $icon;
    protected $position;
    protected $capability;
    protected $slug;

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        $this->init();
    }

    /**
     * register all required hooks for the settings page class.
     */
    public function init() {
        add_action('admin_menu', array($this, 'init_page'));
        add_action('admin_init', array($this, 'register_page_settings'));
    }

    /**
     * action to add the page to the admin menu.
     */
    public function init_page() {
        add_menu_page($this->page_title, $this->menu_title, $this->capability, $this->slug, array($this, 'output_page'), $this->icon, $this->position);
    }

    /**
     * output the page content.
     */
    public function output_page() {
        $this->settings_page_start();
        $this->settings_page_ouptut();
        $this->Settings_page_end();
    }

    /**
     * extension action for page start HTML output.
     */
    public function settings_page_start() {
        echo '<form action="options.php" method="post">';
    }

    /**
     * extension action for page end HTML output.
     */
    public function Settings_page_end() {
        echo '<hr/>';
        submit_button();
        echo '</form>';
    }

    /**
     * override this method to print the output of your settings page.
     */
    public function settings_page_ouptut() {
        $output = '<h2>Example Settings Page</h2>' .
                '<p>override this content by implmenting the output_page() method in your custom page class.</p>';
        echo $output;

        settings_fields('pluginPage');
        do_settings_sections('pluginPage');
    }

    /**
     * registers the page settings for the settings page.
     */
    public function register_page_settings() {
        //regsiter the setting to be saved
        register_setting('pluginPage', 'sample_settings');
        // add the setting section for the input field
        add_settings_section(
            'sample_pluginPage_section', __('Your section description', 'sample'), 'sample_settings_section_callback', 'pluginPage'
        );
        // register the fild using the input class
        $samplefield = new \nk2580\wordsmith\Inputs\Fields\TextField('samplefield', '', false);
        add_settings_field(
            'samplefield', $samplefield->getLabel(), $samplefield->printField(), 'pluginPage', 'sample_pluginPage_section'
        );
    }

}
