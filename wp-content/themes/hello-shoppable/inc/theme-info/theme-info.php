<?php
/**
 * Hello Shoppable - Theme Info Admin Menu
 * @package Bosa Themes
 * @subpackage Admin
 */
if ( ! class_exists( 'Hello_Shoppable_Theme_Info' ) ) {
    class Hello_Shoppable_Theme_Info{

        private $config;
        private $theme_name;
        private $theme_slug;
        private $theme_version;
        private $page_title;
        private $menu_title;
        private $tabs;

        /**
         * Constructor.
         */
        public function __construct( $config ) {
            $this->config = $config;
            $this->prepare_class();

            /*admin menu*/
            add_action( 'admin_menu', array( $this, 'kt_admin_menu' ) );

            /* enqueue script and style for about page */
            add_action( 'admin_enqueue_scripts', array( $this, 'style_and_scripts' ) );

            /* ajax callback for dismissable required actions */
            add_action( 'wp_ajax_kt_theme_info_update_recommended_action', array( $this, 'update_recommended_action_callback' ) );
        }

        /**
         * Prepare and setup class properties.
         */
        public function prepare_class() {
            $theme = wp_get_theme();
            $this->theme_name    = esc_html( $theme->get( 'Name' ) );
            $this->theme_slug    = $theme->get_template();
            $this->theme_version = $theme->get( 'Version' );
            $this->page_title    = $this->theme_name . esc_html__( ' Info', 'hello-shoppable' );
            $this->menu_title    = $this->theme_name . esc_html__( ' Theme', 'hello-shoppable' );
            $this->tabs          = isset( $this->config['tabs'] ) ? $this->config['tabs'] : array();
        }

        /**
         * Return the valid array of recommended actions.
         * @return array The valid array of recommended actions.
         */
        /**
         * Dismiss required actions
         */
        public function update_recommended_action_callback() {

            /*getting for provided array*/
            $recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();

            /*from js action*/
            $action_id = esc_attr( ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0 );
            $todo = esc_attr( ( isset( $_GET['todo'] ) ) ? $_GET['todo'] : '' );

            /*getting saved actions*/
            $saved_actions = get_option( $this->theme_slug . '_recommended_actions' );

            echo esc_html( wp_unslash( $action_id ) ); /* this is needed and it's the id of the dismissable required action */

            if ( ! empty( $action_id ) ) {

                if( 'reset' == $todo ){
                    $saved_actions_new = array();
                    if ( ! empty( $recommended_actions ) ) {

                        foreach ( $recommended_actions as $recommended_action ) {
                            $saved_actions[ $recommended_action['id'] ] = true;
                        }
                        update_option( $this->theme_slug . '_recommended_actions', $saved_actions_new );
                    }
                }
                /* if the option exists, update the record for the specified id */
                elseif ( !empty( $saved_actions) and is_array( $saved_actions ) ) {

                    switch ( esc_html( $todo ) ) {
                        case 'add';
                            $saved_actions[ $action_id ] = true;
                            break;
                        case 'dismiss';
                            $saved_actions[ $action_id ] = false;
                            break;
                    }
                    update_option( $this->theme_slug . '_recommended_actions', $saved_actions );

                    /* create the new option,with false for the specified id */
                }
                else {
                    $saved_actions_new = array();
                    if ( ! empty( $recommended_actions ) ) {

                        foreach ( $recommended_actions as $recommended_action ) {
                            echo esc_html($recommended_action['id']);
                            echo " ". esc_html($todo);
                            if ( $recommended_action['id'] == $action_id ) {
                                switch ( esc_html( $todo ) ) {
                                    case 'add';
                                        $saved_actions_new[ $action_id ] = true;
                                        break;
                                    case 'dismiss';
                                        $saved_actions_new[ $action_id ] = false;
                                        break;
                                }
                            }
                        }
                    }
                    update_option( $this->theme_slug . '_recommended_actions', $saved_actions_new );
                }
            }
            exit;
        }

        private function get_recommended_actions() {
            $saved_actions = get_option( $this->theme_slug . '_recommended_actions' );
            if ( ! is_array( $saved_actions ) ) {
                $saved_actions = array();
            }
            $recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
            $valid       = array();
            if( isset( $recommended_actions ) && is_array( $recommended_actions ) ){
                foreach ( $recommended_actions as $recommended_action ) {
                    if (
                        (
                            ! isset( $recommended_action['check'] ) ||
                            ( isset( $recommended_action['check'] ) && ( $recommended_action['check'] == false ) )
                        )
                        &&
                        ( ! isset( $saved_actions[ $recommended_action['id'] ] ) ||
                            ( isset( $saved_actions[ $recommended_action['id']] ) && ($saved_actions[ $recommended_action['id']] == true ) )
                        )
                    ) {
                        $valid[] = $recommended_action;
                    }
                }
            }
            return $valid;
        }

        private function count_recommended_actions() {
            $count = 0;
            $actions_count = $this->get_recommended_actions();
            if ( ! empty( $actions_count ) ) {
                $count = count( $actions_count );
            }
            return $count;
        }
        
        /**
         * Adding Theme Info Menu under Appearance.
         */
        function kt_admin_menu() {

            if ( ! empty( $this->page_title ) && ! empty( $this->menu_title ) ) {
                $count = $this->count_recommended_actions();
                $menu_title = $count > 0 ? $this->menu_title . '<span class="badge-action-count">' . esc_html( $count ) . '</span>' : $this->menu_title;
                /* Example
                 * add_theme_page('My Plugin Theme', 'My Plugin', 'edit_theme_options', 'my-unique-identifier', 'my_plugin_function');
                 * */
                add_theme_page( $this->page_title, $menu_title, 'edit_theme_options', $this->theme_slug . '-info', array(
                    $this,
                    'kt_theme_info_screen',
                ) );
            }
        }

        /**
         * Render the info content screen.
         */
        public function kt_theme_info_screen() {
            $theme_name_config = esc_attr ( wp_get_theme()->get('Name') );
            $theme_name_config_url = strtolower( str_replace( ' ', '-', $theme_name_config ) );
            if ( ! empty( $this->config['info_title'] ) ) {
                $welcome_title = $this->config['info_title'];
            }
            if ( ! empty( $this->config['info_content'] ) ) {
                $welcome_content = $this->config['info_content'];
            }
            if ( ! empty( $this->config['quick_links'] ) ) {
                $quick_links = $this->config['quick_links'];
            }

            if (
                ! empty( $welcome_title ) ||
                ! empty( $welcome_content ) ||
                ! empty( $quick_links ) ||
                ! empty( $this->tabs )
            ) {
                echo '<div class="wrap about-wrap info-wrap epsilon-wrap">';
                echo '<div class="header-wrap display-grid col-grid-2 align-center">';
                echo '<div class="theme-detail col">';
                if ( ! empty( $welcome_title ) ) {
                    echo '<h1>';
                    echo esc_html( $welcome_title );
                    if ( ! empty( $this->theme_version ) ) {
                        echo esc_html( $this->theme_version ) . ' </sup>';
                    }
                    echo '</h1>';
                }
                if ( ! empty( $welcome_content ) ) {
                    echo '<div class="about-text">' . wp_kses_post( $welcome_content ) . '</div>';
                }

                /*quick links*/
                if( !empty( $quick_links ) && is_array( $quick_links ) ){
                    echo '<p class="quick-links">';
                    foreach ( $quick_links as $quick_key => $quick_link ) {
                        $button = 'button-secondary';
                        if( 'pro_url' == $quick_key ){
                            $button = 'button button-primary button-hero';
                        }
                        echo '<a href="'.esc_url( $quick_link['url'] ).'" class="button button-hero '.esc_attr( $button ).'" target="_blank">'.esc_html( $quick_link['text'] ).'</a>';
                    }
                    echo "</p>";
                }
                echo '</div>';
                echo '<div class="theme-img col">';
                echo '<a href="' . esc_url( 'https://bosathemes.com/' .$theme_name_config_url ).'" target="_blank">';
                echo '<img src="' . get_theme_file_uri() . '/screenshot.png" alt="screenshot" />'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                echo '</a>';
                echo '</div>';
                echo '</div><!--/header-wrap-->';
                /* Display tabs */
                if ( ! empty( $this->tabs ) ) {
                    $current_tab = isset( $_GET['tab'] ) ? wp_unslash( $_GET['tab'] ) : 'getting_started';

                    echo '<h2 class="nav-tab-wrapper wp-clearfix">';
                    $count = $this->count_recommended_actions();
                    foreach ( $this->tabs as $tab_key => $tab_name ) {
                        echo '<a href="' . esc_url( admin_url( 'themes.php?page=' . $this->theme_slug . '-info' ) ) . '&tab=' . esc_attr( $tab_key ) . '" class="nav-tab ' . ( $current_tab == $tab_key ? 'nav-tab-active' : '' ) . '" role="tab" data-toggle="tab">';
                        echo esc_html( $tab_name );
                        if ( $tab_key == 'recommended_actions' ) {
                            if ( $count > 0 ) {
                                echo '<span class="badge-action-count">' . esc_html( $count ) . '</span>';
                            }
                        }
                        echo '</a>';
                    }

                    echo '</h2>';

                    /* Display content for current tab, dynamic method according to key provided*/
                    if ( method_exists( $this, $current_tab ) ) {

                        echo "<div class='changelog point-releases'>";
                        $this->$current_tab();
                        echo "</div>";
                    }
                }
                echo '</div><!--/.wrap.about-wrap-->';
            }
        }

        /**
         * Getting started tab
         */
        public function getting_started() {
            echo '<div class="feature-section display-grid col-grid-3">';
            if ( ! empty( $this->config['gs_steps'] ) ) {
                $gs_steps = $this->config['gs_steps'];
                if ( ! empty( $gs_steps ) ) {

                    /*defaults values for gs_steps array */
                    $defaults = array(
                        'title'     => '',
                        'desc'       => '',
                        'button_label'   => '',
                        'button_link'   => '',
                        'is_button' => true,
                        'is_new_tab' => false,
                        'is_gs' => false,
                    );
                    foreach ( $gs_steps as $gs_step ) {
                        $instance = wp_parse_args( (array) $gs_step, $defaults );

                        /*allowed 7 value in array */
                        $title = $instance[ 'title' ];
                        $desc = $instance[ 'desc'];
                        $button_label = $instance[ 'button_label'];
                        $button_link = $instance[ 'button_link'];
                        $is_button = $instance[ 'is_button'];
                        $is_new_tab = $instance[ 'is_new_tab'];
                        $is_gs = $instance[ 'is_gs' ];
                        
                        echo '<div class="col-items">';
                        
                        if( $is_gs ) {
                            if ( hello_shoppable_all_gs_plugin_active() ) {
                                echo ('<h3>'.esc_html__('Getting Started', 'hello-shoppable').'</h3>');
                                echo ('<p>'.esc_html__('Plugins added successfully.', 'hello-shoppable').'</p>');
                            echo '</div>';
                            }else {
                                if ( ! empty( $title ) ) {
                                    echo '<h3>';
                                    echo esc_html($title);
                                    echo '</h3>';
                                }

                                if ( ! empty( $desc ) ) {
                                    echo '<p>' . esc_html( $desc ) . '</p>';
                                }

                                if ( ! empty( $button_label ) ) {

                                    echo '<p>';
                                    $button_class = '';
                                    if ( $is_button ) {
                                        $button_class = 'button button-primary button-hero hello-shoppable-install-plugins';
                                    }

                                    $button_new_tab = '_self';
                                    if ( isset( $is_new_tab ) ) {
                                        if ( $is_new_tab ) {
                                        $button_new_tab = '_blank';
                                        }
                                    }
                                    echo '<a target="' . esc_attr( $button_new_tab ) . '" class="' . esc_attr( $button_class ). '">' . esc_html( $button_label ) . '</a>';
                                    echo '</p>';
                                }
                                echo '</div>';
                            }
                        }else{
                            if ( ! empty( $title ) ) {
                                echo '<h3>';
                                echo esc_html($title);
                                echo '</h3>';
                            }

                            if ( ! empty( $desc ) ) {
                                echo '<p>' . esc_html($desc) . '</p>';
                            }

                            if ( ! empty( $button_link ) && ! empty( $button_label ) ) {

                                echo '<p>';
                                $button_class = '';
                                if ( $is_button ) {
                                    $button_class = 'button button-primary button-hero';
                                }

                                $button_new_tab = '_self';
                                if ( isset( $is_new_tab ) ) {
                                    if ( $is_new_tab ) {
                                        $button_new_tab = '_blank';
                                    }
                                }
                                echo '<a target="' . esc_attr( $button_new_tab ) . '" href="' . esc_attr( $button_link ) . '" class="' . esc_attr( $button_class ) . '">' . esc_html( $button_label ) . '</a>';
                                echo '</p>';
                            }
                            echo '</div>';
                        }
                    }
                }
            }
            echo '</div><!-- .feature-section col-wrap -->';
        }

        /**
         * Recommended Actions tab
         */
        public function check_plugin_status( $slug ) {

            $path = WPMU_PLUGIN_DIR . '/' . $slug . '/' . $slug . '.php';
            if ( ! file_exists( $path ) ) {
                $path = WP_PLUGIN_DIR . '/' . $slug . '/' . $slug . '.php';
                if ( ! file_exists( $path ) ) {
                    $path = false;
                }
            }

            if ( file_exists( $path ) ) {
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

                $needs = is_plugin_active( $slug . '/' . $slug . '.php' ) ? 'deactivate' : 'activate';

                return array( 'status' => is_plugin_active( $slug . '/' . $slug . '.php' ), 'needs' => $needs );
            }

            return array( 'status' => false, 'needs' => 'install' );
        }

        public function create_action_link( $state, $slug ) {

            switch ( $state ) {
                case 'install':
                    return wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'install-plugin',
                                'plugin' => $slug
                            ),
                            network_admin_url( 'update.php' )
                        ),
                        'install-plugin_' . $slug
                    );
                    break;

                case 'deactivate':
                    return add_query_arg(
                            array(
                                'action'        => 'deactivate',
                                'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
                                'plugin_status' => 'all',
                                'paged'         => '1',
                                '_wpnonce'      => wp_create_nonce( 'deactivate-plugin_' . $slug . '/' . $slug . '.php' )
                                ),
                            network_admin_url( 'plugins.php' )
                    );
                    break;

                case 'activate':
                    return add_query_arg(
                            array(
                                'action'        => 'activate',
                                'plugin'        => rawurlencode( $slug . '/' . $slug . '.php' ),
                                'plugin_status' => 'all',
                                'paged'         => '1',
                                '_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $slug . '/' . $slug . '.php' )
                            ),
                            network_admin_url( 'plugins.php' )
                    );
                    break;
            }
        }

        public function recommended_actions() {

            $recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
            $hooray = true;
            if ( ! empty( $recommended_actions ) ) {

                echo '<div class="feature-section action-recommended demo-import-boxed" id="plugin-filter">';

                if ( ! empty( $recommended_actions ) && is_array( $recommended_actions ) ) {

                    /*get saved recommend actions*/
                    $saved_recommended_actions = get_option( $this->theme_slug . '_recommended_actions' );

                    /*defaults values for getting_started array */
                    $defaults = array(
                        'title'         => '',
                        'desc'          => '',
                        'check'         => false,
                        'plugin_slug'   => '',
                        'id'            => ''
                    );
                    foreach ( $recommended_actions as $action_key => $action_value ) {
                        $instance = wp_parse_args( (array) $action_value, $defaults );

                        /*allowed 5 value in array */
                        $title = $instance[ 'title' ];
                        $desc = $instance[ 'desc' ];
                        $check = $instance[ 'check' ];
                        $plugin_slug = $instance[ 'plugin_slug' ];
                        $id = $instance[ 'id' ];

                        $hidden = false;

                        /*magic check for recommended actions*/
                        if (
                            isset( $saved_recommended_actions[ $id ] ) &&
                            $saved_recommended_actions[ $id ] == false ) {
                            $hidden = true;
                        }
                        if ( $hidden ) {
                            echo '';
                        }
                        $done = '';
                        if ( $check ) {
                           $done = 'done';
                        }

                        echo "<div class='kt-theme-info-action-recommended-box {$done}'>"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                        if ( ! $hidden ) {
                            echo '<span data-action="dismiss" class="dashicons dashicons-visibility kt-theme-info-recommended-action-button" id="' . esc_attr( $action_value['id'] ) . '"></span>';
                        } else {
                            echo '<span data-action="add" class="dashicons dashicons-hidden kt-theme-info-recommended-action-button" id="' . esc_attr( $action_value['id'] ) .'"></span>';
                        }

                        if ( ! empty( $title) ) {
                            echo '<h3>' . wp_kses_post( $title ) . '</h3>';
                        }

                        if ( ! empty( $desc ) ) {
                            echo '<p>' . wp_kses_post( $desc ) . '</p>';
                        }

                        if ( ! empty( $plugin_slug ) ) {

                            $active = $this->check_plugin_status( $action_value['plugin_slug'] );
                            $url    = $this->create_action_link( $active['needs'], $action_value['plugin_slug'] );
                            $label  = '';
                            $class  = '';
                            switch ( $active['needs'] ) {

                                case 'install':
                                    $class = 'install-now button';
                                    $label = esc_html__( 'Install', 'hello-shoppable' );
                                    break;

                                case 'activate':
                                    $class = 'activate-now button button-primary';
                                    $label = esc_html__( 'Activate', 'hello-shoppable' );

                                    break;

                                case 'deactivate':
                                    $class = 'deactivate-now button';
                                    $label = esc_html__( 'Deactivate', 'hello-shoppable' );

                                    break;
                            }

                            ?>
                            <p class="plugin-card-<?php echo esc_attr( $action_value['plugin_slug'] ) ?> action_button <?php echo ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ?>">
                                <a data-slug="<?php echo esc_attr( $action_value['plugin_slug'] ) ?>"
                                   class="<?php echo esc_attr( $class ); ?>"
                                   href="<?php echo esc_url( $url ) ?>"> <?php echo esc_html( $label ) ?> </a>
                            </p>

                            <?php

                        }
                        echo '</div>';
                        $hooray = false;
                    }
                }
                if ( $hooray ){
                    echo '<span class="hooray">' . esc_html__( 'Hooray! There are no recommended actions for you right now.', 'hello-shoppable' ) . '</span>';
                    echo '<a data-action="reset" id="reset" class="reset-all" href="#">'.esc_html__('Show All Recommended Actions', 'hello-shoppable').'</a>';
                }
                echo '</div>';
            }
        }

        /**
         * Free vs Pro tab
         */
        public function free_pro() {
            $theme_name_config = esc_attr ( wp_get_theme()->get('Name') );
            $theme_name_config_url = strtolower( str_replace( ' ', '-', $theme_name_config ) );

            $free_pro = isset( $this->config['free_pro'] ) ? $this->config['free_pro'] : array();
            if ( ! empty( $free_pro ) ) {
                /*defaults values for child theme array */
                $defaults = array(
                    'title'=> '',
                    'desc' => '',
                    'free' => '',
                    'pro'  => '',
                );

                if ( ! empty( $free_pro ) && is_array( $free_pro ) ) {
                    echo '<div class="feature-section">';
                    echo '<div id="free_pro" class="hello-shoppable-theme-info-tab-pane hello-shoppable-theme-info-fre-pro">';
                    echo '<table class="free-pro-table table-light-wrapper hello-shoppable-theme-info-text-center">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>' . esc_html__( 'Theme Features','hello-shoppable' ) . '</th>';
                    echo '<th>' . esc_html__( 'Free','hello-shoppable' ) . '</th>';
                    echo '<th>' . esc_html__( 'Pro (Premium)','hello-shoppable' ) . '</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ( $free_pro as $feature ) {

                        $instance = wp_parse_args( (array) $feature, $defaults );

                        /*allowed 7 value in array */
                        $title = $instance[ 'title' ];
                        $desc = $instance[ 'desc'];
                        $free = $instance[ 'free'];
                        $pro = $instance[ 'pro'];

                        echo '<tr>';
                        if ( ! empty( $title ) || ! empty( $desc ) ) {
                            echo '<td>';
                            if ( ! empty( $title ) ) {
                                echo '<h3>' . wp_kses_post( $title ) . '</h3>';
                            }
                            if ( ! empty( $desc ) ) {
                                echo '<p>' . wp_kses_post( $desc ) . '</p>';
                            }
                            echo '</td>';
                        }

                        if ( ! empty( $free )) {
                            if( 'yes' === $free ){
                                echo '<td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>';
                            }
                            elseif ( 'no' === $free ){
                                echo '<td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>';
                            }
                            else{
                                echo '<td class="only-lite">'.esc_html($free ).'</td>';
                            }

                        }
                        if ( ! empty( $pro )) {
                            if( 'yes' === $pro ){
                                echo '<td class="only-lite"><span class="dashicons-before dashicons-yes"></span></td>';
                            }
                            elseif ( 'no' === $pro ){
                                echo '<td class="only-pro"><span class="dashicons-before dashicons-no-alt"></span></td>';
                            }
                            else{
                                echo '<td class="only-lite">'.esc_html($pro ).'</td>';
                            }
                        }
                        echo '</tr>';
                    }

                    echo '<tr>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td><a href="' . esc_url( 'https://wpshopkits.com/' .$theme_name_config_url ).'/#pricing" target="_blank" class="button button-primary button-hero">Buy Pro</a></td>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                    echo '</div>';

                }
            }
        }

        /**
         * Recommended plugins tab
         */
        /*
         * Call plugin api
         */
        public function call_plugin_api( $slug ) {
            include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

            if ( false === ( $call_api = get_transient( 'kt_theme_info_plugin_information_transient_' . $slug ) ) ) {
                $call_api = plugins_api( 'plugin_information', array(
                    'slug'   => $slug,
                    'fields' => array(
                        'downloaded'        => false,
                        'rating'            => false,
                        'description'       => false,
                        'short_description' => true,
                        'donate_link'       => false,
                        'tags'              => false,
                        'sections'          => true,
                        'homepage'          => true,
                        'added'             => false,
                        'last_updated'      => false,
                        'compatibility'     => false,
                        'tested'            => false,
                        'requires'          => false,
                        'downloadlink'      => false,
                        'icons'             => true
                    )
                ) );
                set_transient( 'kt_theme_info_plugin_information_transient_' . $slug, $call_api, 30 * MINUTE_IN_SECONDS );
            }

            return $call_api;
        }
        public function get_plugin_icon( $arr ) {

            if ( ! empty( $arr['svg'] ) ) {
                $plugin_icon_url = $arr['svg'];
            } elseif ( ! empty( $arr['2x'] ) ) {
                $plugin_icon_url = $arr['2x'];
            } elseif ( ! empty( $arr['1x'] ) ) {
                $plugin_icon_url = $arr['1x'];
            } else {
                $plugin_icon_url = get_template_directory_uri() . '/assets/placeholder_plugin.png';
            }

            return $plugin_icon_url;
        }
        public function recommended_plugins() {
            $recommended_plugins = $this->config['recommended_plugins'];

            if ( ! empty( $recommended_plugins ) ) {
                if ( ! empty( $recommended_plugins ) && is_array( $recommended_plugins ) ) {

                    echo '<div class="feature-section recommended-plugins col-wrap demo-import-boxed" id="plugin-filter">';

                    foreach ( $recommended_plugins as $recommended_plugins_item ) {

                        if ( ! empty( $recommended_plugins_item['slug'] ) ) {
                            $info   = $this->call_plugin_api( $recommended_plugins_item['slug'] );
                            if ( ! empty( $info->icons ) ) {
                                $icon = $this->get_plugin_icon( $info->icons );
                            }

                            $active = $this->check_plugin_status( $recommended_plugins_item['slug'] );

                            if ( ! empty( $active['needs'] ) ) {
                                $url = $this->create_action_link( $active['needs'], $recommended_plugins_item['slug'] );
                            }

                            echo '<div class="col"><div class="col-items plugin_box">';
                            if ( ! empty( $icon ) ) {
                                echo '<img src="'.esc_url( $icon ).'" alt="plugin box image">';
                            }
                            if ( ! empty(  $info->version ) ) {
                                echo '<span class="version">'. ( ! empty( $this->config['recommended_plugins']['version_label'] ) ? esc_html( $this->config['recommended_plugins']['version_label'] ) : '' ) . esc_html( $info->version ).'</span>';
                            }
                            if ( ! empty( $info->author ) ) {
                                echo '<span class="separator"> | </span>' . wp_kses_post( $info->author );
                            }

                            if ( ! empty( $info->name ) && ! empty( $active ) ) {
                                echo '<div class="action_bar ' . ( ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ) . '">';
                                echo '<span class="plugin_name">' . ( ( $active['needs'] !== 'install' && $active['status'] ) ? 'Active: ' : '' ) . esc_html( $info->name ) . '</span>';
                                echo '</div>';

                                $label = '';

                                switch ( $active['needs'] ) {

                                    case 'install':
                                        $class = 'install-now button';
                                        $label = esc_html__( 'Install', 'hello-shoppable' );
                                        break;

                                    case 'activate':
                                        $class = 'activate-now button button-primary';
                                        $label = esc_html__( 'Activate', 'hello-shoppable' );

                                        break;

                                    case 'deactivate':
                                        $class = 'deactivate-now button';
                                        $label = esc_html__( 'Deactivate', 'hello-shoppable' );

                                        break;
                                }

                                echo '<span class="plugin-card-' . esc_attr( $recommended_plugins_item['slug'] ) . ' action_button ' . ( ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ) . '">';
                                echo '<a data-slug="' . esc_attr( $recommended_plugins_item['slug'] ) . '" class="' . esc_attr( $class ) . '" href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
                                echo '</span>';
                            }
                            echo '</div></div><!-- .col.plugin_box -->';
                        }
                    }
                    echo '</div><!-- .recommended-plugins -->';
                }
            }
        }

        /**
         * Child themes
         */
        public function child_themes() {
            echo '<div id="child-themes" class="kt-theme-info-tab-pane">';
            $child_themes = isset( $this->config['child_themes'] ) ? $this->config['child_themes'] : array();
            if ( ! empty( $child_themes ) ) {

                /*defaults values for child theme array */
                $defaults = array(
                    'title'        => '',
                    'screenshot'   => '',
                    'download_link'=> '',
                    'preview_link' => ''
                );
                if ( ! empty( $child_themes ) && is_array( $child_themes ) ) {
                    echo '<div class="kt-about-row">';
                    $i = 0;
                    foreach ( $child_themes as $child_theme ){
                        $instance = wp_parse_args( (array) $child_theme, $defaults );

                        /*allowed 5 value in array */
                        $title = $instance[ 'title' ];
                        $screenshot = $instance[ 'screenshot'];
                        $download_link = $instance[ 'download_link'];
                        $preview_link = $instance[ 'preview_link'];

                        if( !empty( $screenshot) ){
                            echo '<div class="kt-about-child-theme">';
                            echo '<div class="kt-theme-info-child-theme-image">';

                            echo '<img src="' . esc_url( $screenshot ) . '" alt="' . ( ! empty( $title ) ? esc_attr( $title ) : '' ) . '" />';

                            if ( ! empty( $title ) ) {
                                echo '<div class="kt-theme-info-child-theme-details">';
                                echo '<div class="theme-details">';
                                echo '<span class="theme-name">' . esc_html( $title  ). '</span>';
                                if ( ! empty( $download_link ) ) {
                                    echo '<a href="' . esc_url( $download_link ) . '" class="button button-primary install right">' . esc_html__( 'Download', 'hello-shoppable' ) . '</a>';
                                }
                                if ( ! empty( $preview_link ) ) {
                                    echo '<a class="button button-secondary preview right" target="_blank" href="' . esc_attr( $preview_link ) . '">' . esc_html__( 'Live Preview', 'hello-shoppable' ). '</a>';
                                }
                                echo '</div>';
                                echo '</div>';
                            }

                            echo "</div>";
                            echo "</div>";
                            $i++;
                        }
                        if( 0 == $i % 3 ){
                            echo "</div><div class='kt-about-row'>";/*.kt-about-row end-start*/
                        }
                    }

                    echo '</div>';/*.kt-about-row end*/
                }// End if().
            }// End if().
            echo '</div>';
        }

        /**
         * Support tab
         */
        public function support() {
            echo '<div class="feature-section col-wrap">';

            if ( ! empty( $this->config['support_content'] ) ) {

                $supports = $this->config['support_content'];

                if ( ! empty( $supports ) ) {

                    /*defaults values for child theme array */
                    $defaults = array(
                        'title' => '',
                        'icon' => '',
                        'desc' => '',
                        'button_label' => '',
                        'button_link' => '',
                        'is_button' => true,
                        'is_new_tab' => true
                    );

                    foreach ( $supports as $support ) {
                        $instance = wp_parse_args( (array) $support, $defaults );

                        /*allowed 7 value in array */
                        $title = $instance[ 'title' ];
                        $icon = $instance[ 'icon'];
                        $desc = $instance[ 'desc'];
                        $button_label = $instance[ 'button_label'];
                        $button_link = $instance[ 'button_link'];
                        $is_button = $instance[ 'is_button'];
                        $is_new_tab = $instance[ 'is_new_tab'];
                        
                        echo '<div class="col"><div class="col-items">';

                        if ( ! empty( $title ) ) {
                            echo '<h3>';
                            if ( ! empty( $icon ) ) {
                                echo '<i class="' . esc_attr( $icon ) . '"></i>';
                            }
                            echo esc_html($title);
                            echo '</h3>';
                        }

                        if ( ! empty( $desc ) ) {
                            echo '<p>' . esc_html( $desc ) . '</p>';
                        }

                        if ( ! empty( $button_link ) && ! empty( $button_label ) ) {

                            echo '<p>';
                            $button_class = '';
                            if ( $is_button ) {
                                $button_class = 'button button-primary button-hero';
                            }

                            $button_new_tab = '_self';
                            if ( isset( $is_new_tab ) ) {
                                if ( $is_new_tab ) {
                                    $button_new_tab = '_blank';
                                }
                            }
                            echo '<a target="' . esc_attr( $button_new_tab ) . '" href="' . esc_attr( $button_link ) . '" class="' . esc_attr( $button_class ) . '">' . esc_html( $button_label ) . '</a>';
                            echo '</p>';
                        }
                        echo '</div></div>';
                    }
                }
            }
            echo '</div>';
        }

        /**
         * Changelog tab
         */
        private function parse_changelog() {
            WP_Filesystem();
            global $wp_filesystem;
            if ( is_child_theme() ){
                $changelog = $wp_filesystem->get_contents( get_stylesheet_directory() . '/inc/theme-info/changelog.txt' );
            }else{
                $changelog = $wp_filesystem->get_contents( get_template_directory() . '/inc/theme-info/changelog.txt' );
            }
            if ( is_wp_error( $changelog ) ) {
                $changelog = '';
            }
            return $changelog;
        }

        public function changelog() {
            $changelog = $this->parse_changelog();
            if ( ! empty( $changelog ) ) {
                echo '<div class="featured-section changelog">';
                echo "<pre class='changelog'>";
                echo esc_html($changelog);
                echo "</pre>";
                echo '</div><!-- .featured-section.changelog -->';
            }
        }

         /**
         * Demos tab
         */
        public function demos(){
            if( ! empty( $this->config['demos'] ) ){
                $demos= $this->config['demos'];
                    if( ! empty($demos) ){

                    /*defaults values for demos array */
                        $defaults = array(
                            'title'     => '',
                            'desc'       => '',
                            'recommended_actions'=> '',
                            'link_title'   => '',
                            'link_url'   => '',
                            'is_button' => false,
                            'is_new_tab' => false
                        );

                         echo '<div class="feature-section col-wrap">';

                        foreach ( $demos as $demos_item ) {

                            /*allowed 6 value in array */
                            $instance = wp_parse_args( (array) $demos_item, $defaults );
                            /*default values*/
                            $title = esc_html( $instance[ 'title' ] );
                            $desc = wp_kses_post( $instance[ 'desc' ] );
                            $link_title = esc_html( $instance[ 'link_title' ] );
                            $link_url = esc_url( $instance[ 'link_url' ] );
                            $is_button = $instance[ 'is_button' ];
                            $is_new_tab = $instance[ 'is_new_tab' ];


                            echo '<div class="col"><div class="col-items">';
                            if ( ! empty( $title ) ) {
                                echo '<h3>' . esc_html( $title ) . '</h3>';
                            }
                            if ( ! empty( $desc ) ) {
                                echo '<p>' . esc_html( $desc ). '</p>';
                            }
                            if ( ! empty( $link_title ) && ! empty( $link_url ) ) {

                                echo '<p>';
                                $button_class = '';
                                if ( $is_button ) {
                                    $button_class = 'button button-primary';
                                }

                                $count = $this->count_recommended_actions();

                                if ( $demos_item['recommended_actions'] && isset( $count ) ) {
                                    if ( $count == 0 ) {
                                        echo '<span class="dashicons dashicons-yes"></span>';
                                    } else {
                                        echo '<span class="dashicons dashicons-no-alt"></span>';
                                    }
                                }

                                $button_new_tab = '_self';
                                if ( $is_new_tab ) {
                                    $button_new_tab = '_blank';
                                }

                                echo '<a target="' . esc_attr( $button_new_tab ) . '" href="' . esc_attr( $demos_item['link_url'] ) . '"class="' . esc_attr( $button_class ) . '">' . esc_html ( $demos_item['link_title'] ) . '</a>';
                                echo '</p>';
                            }
                            echo '</div></div><!-- .col -->';
                        }
                        echo '</div><!-- .feature-section three-col -->';
                    }
             }
        }

        /**
         * Load css and scripts for the about page
         */
        public function style_and_scripts( $hook_suffix ) {

            // this is needed on all admin pages, not just the about page, for the badge action count in the WordPress main sidebar
            wp_enqueue_style( 'kt-theme-info-css', get_template_directory_uri() . '/inc/theme-info/assets/css/theme-info.css' );

            if ( 'appearance_page_' . $this->theme_slug . '-info' == $hook_suffix ) {

                wp_enqueue_script( 'kt-theme-info-js', get_template_directory_uri() . '/inc/theme-info/assets/js/theme-info.js', array( 'jquery' ) );

                wp_enqueue_style( 'plugin-install' );
                wp_enqueue_script( 'plugin-install' );
                wp_enqueue_script( 'updates' );

                $count = $this->count_recommended_actions();
                wp_localize_script( 'kt-theme-info-js', 'kt_theme_info_object', array(
                    'nr_actions_recommended'   => $count,
                    'ajaxurl'                  => admin_url( 'admin-ajax.php' ),
                    'template_directory'       => get_template_directory_uri()
                ) );

            }

        }
    }
}

$theme_name_config = esc_attr ( wp_get_theme()->get('Name') );
$theme_name_config_url = strtolower( str_replace( ' ', '-', $theme_name_config ) );
$config = array(

    // Main welcome title
    /* translators: %s - Theme Name*/
    'info_title' => sprintf( esc_html__( 'Welcome to %s - ', 'hello-shoppable' ), $theme_name_config ),

    // Main welcome content
    /* translators: %s - Theme Name*/
    'info_content' => sprintf( esc_html__( '%s is now installed and ready to use. We hope the following information will help and you enjoy using it!', 'hello-shoppable' ), '<b>'.$theme_name_config.'</b>' ),

    /**
     * Quick links
     */
    'quick_links' => array(
        'theme_url'  => array(
            'text' => __( 'Theme Info', 'hello-shoppable' ),
            'url' => 'https://bosathemes.com/' .$theme_name_config_url 
        ),
        'pro_url'  => array(
            'text' => __( 'Buy Pro', 'hello-shoppable' ),
            'url' => 'https://bosathemes.com/shoppable-pro#pricing-table'
        ),
    ),

    'tabs' => array(
        'getting_started'      => esc_html__( 'Getting Started', 'hello-shoppable' ),
        'free_pro'             => esc_html__( 'Compare Free Vs Pro', 'hello-shoppable' ),
        'recommended_plugins'  => esc_html__( 'Recommended Plugins', 'hello-shoppable' ),
        'support'              => esc_html__( 'Support', 'hello-shoppable' ),
        'changelog'            => esc_html__( 'Changelog', 'hello-shoppable' ),
        'demos'                => esc_html__( 'Demos', 'hello-shoppable' ),
    ),

    /*Getting started tab*/
    'gs_steps' => array(
        'first' => array(
           'title' => esc_html__( 'Getting Started', 'hello-shoppable' ),
           'desc' => esc_html__( 'By clicking "Get Started," you will install and activate essential plugins to prepare your demo import.', 'hello-shoppable' ),
           /* translators: %s - Theme Name*/
            'button_label' => sprintf(esc_html__( 'Get started with %s', 'hello-shoppable' ), $theme_name_config ),
            'is_button' => true,
            'recommended_actions' => false,
            'is_new_tab' => true,
            'is_gs' => true,
        ),
        'second' => array(
            'title' => esc_html__( 'Pre-built Demos', 'hello-shoppable' ),
            'desc' => esc_html__( 'We recommend utilizing our collection of pre-designed starter site templates as an efficient and convenient way to begin your project.', 'hello-shoppable' ),
            'button_label' => esc_html__( 'Browse Demos', 'hello-shoppable' ),
            'button_link' => esc_url( 'https://bosathemes.com/shoppable-pro/#template-list' ),
            'is_button' => true,
            'is_new_tab' => true
        ),
        'third' => array (
            'title' => esc_html__( 'Import Demo', 'hello-shoppable' ),
            'desc' => esc_html__( 'The quick demo import setup will help you configure your new website like theme demo.', 'hello-shoppable' ),
            'button_label' => esc_html__( 'Import Demo', 'hello-shoppable' ),
            'button_link' => esc_url( admin_url( 'themes.php?page=advanced-import' ) ),
            'is_button' => true,
            'is_new_tab' => false
        ),
        'fourth' => array (
            'title' => esc_html__( 'Go to Customizer', 'hello-shoppable' ),
            'desc' => esc_html__( 'All Settings, Header & Footer Options and Theme Options are available via Customize screen.', 'hello-shoppable' ),
            'button_label' => esc_html__( 'Go to Customizer', 'hello-shoppable' ),
            'button_link' => esc_url( admin_url( 'customize.php' ) ),
            'is_button' => true,
            'is_new_tab' => true
        ),
        'fifth' => array(
            'title' => esc_html__( 'Documentation', 'hello-shoppable' ),
            'desc' => esc_html__( 'We kindly request that you refer to the theme documentation for additional guidance on how to utilize its features.', 'hello-shoppable' ),
            'button_label' => esc_html__( 'View Documentation', 'hello-shoppable' ),
            'button_link' => esc_url( 'https://bosathemes.com/docs/shoppable' ),
            'is_button' => true,
            'is_new_tab' => true
        ),
        'sixth' => array(
            'title' => esc_html__( 'Love Our Product?', 'hello-shoppable' ),
            'desc' => esc_html__( 'We would greatly appreciate your motivation through a 5-star rating on our profile.', 'hello-shoppable' ),
            'button_label' => esc_html__( 'Rate Us', 'hello-shoppable' ),
            'button_link' => esc_url( 'https://wordpress.org/support/theme/' .$theme_name_config_url. '/reviews' ),
            'is_button' => true,
            'is_new_tab' => true
        ),
    ),

    // recommended actions array.
    'recommended_actions' => array(

    ),

    // Free vs pro array.
    'free_pro' => array(
        array(
            'title'=> __( '# E-Commerce (WooCommerce):', 'hello-shoppable' ),
            'free' => '',
            'pro'  => '',
        ),
        array(
            'desc'=> __( 'Compare', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Wishlist', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Gallery Zoom/Slider', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Quick View', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Variation Swatches', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Popup Login/Register', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Mega Menu Support', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'PopUp Cart', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Ajax Add To Cart', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Floating Product Info', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Sale Countdown', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Per Page User Filter', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Infinite Scroll', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Off Canvas Filter', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Ajax Products Search', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Social Sharing Buttons', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Search in SKU', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Image Flipper', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Gallery Images', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Products Per Page', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'WooCommerce Breadcrumbs', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Products Per Row', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Product Button Layouts', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Product Sale Tag Options', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Shop Page Display Options', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Category Display Options', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Products Sorting', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'title'=> __( '# Usage:', 'hello-shoppable' ),
            'free' => '',
            'pro'  => '',
        ),
        array(
            'desc'=> __( 'Free Starters Sites', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ), 
        array(
            'desc'=> __( 'Premium Starters Sites', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ), 
        array(
            'desc'=> __( 'Priority Support', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'title'=> __( '# General', 'hello-shoppable' ),
            'free' => '',
            'pro'  => '',
        ),
        array(
            'desc'=> __( 'Header: Multiple Layouts', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Header: Sticky Header', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Header: Transparent Header', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Header: Notification Toolbar', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Footer: Multiple Layouts', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Footer: Copyright(Credits) Editor', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Multiple Site Preloading Options', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Coming Soon Mode', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Pre-Built Starter Child Theme', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'One Click Demo Import', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'One Page Site Ready', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Multiple Site Skins', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Multiple Site Layouts', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Multiple Typography', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Custom Colors', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Google Fonts', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Font Icons', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Sticky Sidebar', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'WooCommerce Sidebar', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Off-Canvas Sidebar', 'hello-shoppable' ),
            'free' => __( 'no','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'title'=> __( '# Blog', 'hello-shoppable' ),
            'free' => '',
            'pro'  => '',
        ),
        array(
            'desc'=> __( 'Archive: Multiple Post Layouts', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Hero Slider/Banner for Posts/Pages', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Content - Sidebar Positions', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Archive: Exerpt Lenth Control', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Single Posts: Feature Image Options', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Single Posts: Related Posts', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Single Posts: Content - Sidebar Positions', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'title'=> __( '# Elementor', 'hello-shoppable' ),
            'free' => '',
            'pro'  => '',
        ),
        array(
            'desc'=> __( 'Starter Site Templates', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Advanced General Widgets', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Advanced WooCommerce Widgets', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'title'=> __( '# Other', 'hello-shoppable' ),
            'free' => '',
            'pro'  => '',
        ),
        array(
            'desc'=> __( 'Lighting Fast', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Responsive', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'SEO Optimized', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Multilingual Compatibility', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Popular Plugins Compatibility', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Gutenberg Compatibility', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Browser Compatibility', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'RTL/LTR Language Support', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Bootstrap Grid', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'HTML5 & CSS3', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
        array(
            'desc'=> __( 'Clear Documentation', 'hello-shoppable' ),
            'free' => __( 'yes','hello-shoppable' ),
            'pro'  => __( 'yes','hello-shoppable' ),
        ),
    ),

    // Generic Plugins array.
    'recommended_plugins' => array(
        'Kirki' => array(
            'slug' => 'kirki'
        ),
        'Elementor' => array(
            'slug' => 'elementor'
        ),
        'Keon Toolset' => array(
            'slug' => 'keon-toolset'
        ),
        'Advanced Import' => array(
            'slug' => 'advanced-import'
        ),
    ),

    // Support content tab.
    'support_content' => array(
        'first' => array(
            'title' => esc_html__( 'Have Question? Ask Us, Now!', 'hello-shoppable' ),
            'desc' => esc_html__( 'We are committed to resolving any issues that may arise to ensure a seamless experience while using shoppable.', 'hello-shoppable' ),
            'button_label' => esc_html__( 'Get Support', 'hello-shoppable' ),
            'button_link' => esc_url( 'https://bosathemes.com/contact-us' ),
            'is_button' => true,
            'is_new_tab' => true
        ),
        'second' => array(
            'title' => esc_html__( 'Customization Request', 'hello-shoppable' ),
            'desc' => esc_html__( 'Needed any customization for the theme, you can request from here.', 'hello-shoppable' ),
            'button_label' => esc_html__( 'Customization Request', 'hello-shoppable' ),
            'button_link' => esc_url( 'https://bosathemes.com/hire-us' ),
            'is_button' => true,
            'is_new_tab' => true
        )
    ),

    //demos
    'demos' => array (
        'first'=> array(
            'title' => esc_html__( 'Pre-built Demos', 'hello-shoppable' ),
            'desc' => esc_html__ ( 'To get started with ready-made starter site templates.', 'hello-shoppable' ),
            'link_title' => esc_html__( 'View All Demos', 'hello-shoppable' ),
            'link_url' => esc_url( 'https://bosathemes.com/shoppable-pro/#template-list' ),
            'is_button' => true,
            'recommended_actions' => false,
            'is_new_tab' => true
        ),
    ),
);
return new Hello_Shoppable_Theme_Info( $config );