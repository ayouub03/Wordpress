<?php
/**
 * Template part for header category menu
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hello Shoppable
 */
?>
<?php
$width_control = '';
if( !get_theme_mod( 'enable_header_cat_menu_width', false ) ){
    $width_control = ' cat-menu-text-overflow';
}
if ( has_nav_menu( 'menu-4' ) ) {
    ?>
    <nav class="header-category-nav<?php echo esc_attr( $width_control ); ?>">
        <ul class="nav navbar-nav navbar-left">
            <li class="menu-item menu-item-has-children">
                <a href="#">
                    <span class="menu-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="32px" height="20px" viewBox="0 0 32 20" enable-background="new 0 0 32 20" xml:space="preserve">
                            <path fill="#313131" d="M29.958,4.141H2.042C1.466,4.141,1,3.47,1,2.641s0.466-1.5,1.042-1.5h27.917c0.575,0,1.042,0.672,1.042,1.5
                                S30.533,4.141,29.958,4.141z"/>
                            <path fill="#313131" d="M29.958,11.503H2.042c-0.575,0-1.042-0.672-1.042-1.5c0-0.828,0.466-1.5,1.042-1.5h27.917
                                c0.575,0,1.042,0.672,1.042,1.5C31,10.831,30.533,11.503,29.958,11.503z"/>
                            <path fill="#313131" d="M29.958,18.864H2.042c-0.575,0-1.042-0.672-1.042-1.5s0.466-1.5,1.042-1.5h27.917
                                c0.575,0,1.042,0.672,1.042,1.5S30.533,18.864,29.958,18.864z"/>
                        </svg>
                    </span>
                    <span class="category-menu-label">
                        <?php echo esc_html( get_theme_mod( 'header_woo_cat_menu_label', '' ) ); ?>
                    </span>
                </a>
                <?php
                wp_nav_menu(array(
                    'container'      => '',
                    'theme_location' => 'menu-4',
                    'menu_id'        => 'woo-cat-menu',
                    'menu_class' => 'dropdown-menu',
                ));
                ?>
            </li>
        </ul>
    </nav>
    <?php
}else{
    if( class_exists( 'WooCommerce' ) ){
        $categories = get_categories( 'taxonomy=product_cat' );
        if( is_array( $categories ) && !empty( $categories ) ){
            ?>
            <nav class="header-category-nav<?php echo esc_attr( $width_control ); ?>">
                <ul class="nav navbar-nav navbar-left">
                    <li class="menu-item menu-item-has-children">
                        <a href="#">
                            <span class="menu-icon">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 width="32px" height="20px" viewBox="0 0 32 20" enable-background="new 0 0 32 20" xml:space="preserve">
                                    <path fill="#313131" d="M29.958,4.141H2.042C1.466,4.141,1,3.47,1,2.641s0.466-1.5,1.042-1.5h27.917c0.575,0,1.042,0.672,1.042,1.5
                                        S30.533,4.141,29.958,4.141z"/>
                                    <path fill="#313131" d="M29.958,11.503H2.042c-0.575,0-1.042-0.672-1.042-1.5c0-0.828,0.466-1.5,1.042-1.5h27.917
                                        c0.575,0,1.042,0.672,1.042,1.5C31,10.831,30.533,11.503,29.958,11.503z"/>
                                    <path fill="#313131" d="M29.958,18.864H2.042c-0.575,0-1.042-0.672-1.042-1.5s0.466-1.5,1.042-1.5h27.917
                                        c0.575,0,1.042,0.672,1.042,1.5S30.533,18.864,29.958,18.864z"/>
                                </svg>
                            </span>
                            <span class="category-menu-label">
                                <?php echo esc_html( get_theme_mod( 'header_woo_cat_menu_label', '' ) ); ?>
                            </span>
                        </a>
                        <ul class="menu-categories-menu dropdown-menu">
                            <?php
                            foreach( $categories as $category ) {
                                $category_permalink = get_category_link( $category->cat_ID );
                                ?>
                                <li class="menu-item <?php echo esc_attr( $category->category_nicename ); ?>">
                                    <a href="<?php echo esc_url( $category_permalink ); ?>">
                                        <?php echo esc_html( $category->cat_name ); ?>
                                    </a>
                                </li>  
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </nav>
            <?php
        }
    }
}
