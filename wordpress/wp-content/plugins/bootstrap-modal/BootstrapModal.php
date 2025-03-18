<?php

class BootstrapModal {

    private $wpdb;
    private $request;
    private $server;

    public function __construct(array $request, array $server, wpdb $wpdb){
        $this->wpdb = $wpdb;
        $this->request = $request;
        $this->server = $server;
    }

    public function init() {
        add_action('init', [$this, 'postType']);
        add_action('wp_footer', [$this, 'html']);
        add_action('wp_enqueue_scripts', [$this, 'resources']);
    }

    function postType() {
        register_post_type('modal',
            [
                'labels' => [
                    'name'          => __('Modals', 'textdomain'),
                    'singular_name' => __('Modal', 'textdomain'),
                ],
                'public'      => false,
                'has_archive' => false,
                'show_ui'     => true,
                'show_in_admin_bar' => false,
                'show_in_rest' => true
            ]
        );
    }

    function resources() {
        /* CSS */
        wp_enqueue_style('bootstrap-modal-styles', plugins_url('resources/css/modal.css' , __FILE__), [], '1.0', 'all');
    
        /* JS */
        wp_enqueue_script('bootstrap-modal-scripts', plugins_url('resources/js/modal.js' , __FILE__), [], '1.0', true);
    }
    
    function html() {
        echo '
            <div class="modal fade" id="bootstrap-modal" tabindex="-1" aria-labelledby="bootstrap-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header p-0  pt-4 pe-4 border-bottom-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <div class="modal-body px-5 pt-1"></div>
                    </div>
                </div>
            </div>
        ';
    }
  
}
