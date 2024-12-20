<?php

function wpdevart_theme_backend_enqueue() {
    wp_enqueue_style( 'wpdevart-theme-jewstore-getting-started', get_template_directory_uri() . '/inc/getting-started/notice.css' );
}
add_action( 'admin_enqueue_scripts', 'wpdevart_theme_backend_enqueue' );

function wpdevart_jewstore_menu() {
	add_theme_page( esc_html__( 'About Theme', 'jewstore' ), esc_html__( 'About Theme', 'jewstore' ), 'edit_theme_options', 'wpdevart-theme-about', 'wpdevart_jewstore_about_display' );
}
add_action( 'admin_menu', 'wpdevart_jewstore_menu' );

function wpdevart_jewstore_about_display() {
	$wpdevart_jewstore_theme = wp_get_theme();
	?>
	<div class="wrap about-wrap full-width-layout wpdevart-admin-container">
		<div class="wpdevart-about-theme">
			<div class="wpdevart-theme-description">
				<h1 class="getting-started-heading"><?php echo esc_html( $wpdevart_jewstore_theme ); ?></h1>
				<p class="about-text"><?php echo apply_filters( 'parent_wpdevart_child_description_text', esc_html('JewStore is a responsive and modern WordPress theme designed specifically for jewelry stores and blogs. The theme is fully integrated with WooCommerce and comes with a lot of options and settings, making it easy and quick to create a jewelry store from scratch. JewStore has many advantages that set it apart from other WordPress themes. The main advantage of the theme is a ready-to-use and customizable home page. All you have to do is enable the built-in home page, make a few minor changes (such as changing the default links or texts if needed), and there you have it, a beautiful, ready-made home page.')); ?></p>
				<p class="actions">
					<a target="_blank" href="<?php echo apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')); ?>" class="button button-secondary getting-started-main-button" target="_blank"><?php esc_html_e( 'Theme Info', 'jewstore' ); ?></a>
					<a target="_blank" href="<?php echo apply_filters( 'parent_wpdevart_child_demo_url', esc_url('https://jewstore.wpdevart.com')); ?>" class="button button-secondary getting-started-main-button" target="_blank"><?php esc_html_e( 'Demo', 'jewstore' ); ?></a>
                    <a target="_blank" href="<?php echo apply_filters( 'parent_wpdevart_child_wp_support_url', esc_url('https://wordpress.org/support/theme/jewstore')); ?>" class="button button-secondary getting-started-main-button" target="_blank"><?php esc_html_e( 'Support', 'jewstore' ); ?></a>
					<a target="_blank" href="<?php echo apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')); ?>" class="button button-secondary getting-started-main-button getting-started-focus-button" target="_blank"><?php esc_html_e( 'Upgrade to Premium', 'jewstore' ); ?></a>
                    <a target="_blank" href="<?php echo esc_url('https://wpdevart.com/hire-wordpress-developer-dedicated-experts-are-ready-to-help/'); ?>" class="button button-secondary getting-started-main-button getting-started-focus-button" target="_blank"><?php esc_html_e( 'Hire a Developer', 'jewstore' ); ?></a>
				</p>
			</div>
			<div class="wpdevart-theme-screenshot">
				<img src="<?php echo esc_url( $wpdevart_jewstore_theme->get_screenshot() ); ?>" />
			</div>
		</div>
		<nav class="nav-tab-wrapper wp-clearfix wpdevart-admin-tab" aria-label="<?php esc_attr_e( 'Secondary menu', 'jewstore' ); ?>">
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wpdevart-theme-about' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['page'] ) && 'wpdevart-theme-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'About', 'jewstore' ); ?></a>
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wpdevart-theme-about', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Free Vs Pro', 'jewstore' ); ?></a>
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wpdevart-theme-about', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'FAQ', 'jewstore' ); ?></a>
		</nav>
		<?php
			wpdevart_jewstore_main_screen();
			wpdevart_jewstore_changelog_screen();
			wpdevart_jewstore_free_vs_pro();
		?>
	</div>
	<?php
}

function wpdevart_jewstore_main_screen() {
	if ( isset( $_GET['page'] ) && 'wpdevart-theme-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) {
	?>
		<div class="feature-section two-col wpdevart-feature-section">
			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'jewstore' ); ?></h2>
				<p><?php esc_html_e( 'You can edit and change theme options using the customizer. All theme options are available via Customize screen.', 'jewstore' ) ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-secondary getting-started-main-button"><?php esc_html_e( 'Customize', 'jewstore' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Got theme support question?', 'jewstore' ); ?></h2>
				<p><?php esc_html_e( 'If you have any questions regarding our theme, you can add a support ticket and get fast support from our team.', 'jewstore' ) ?></p>
				<p><a target="_blank" href="<?php echo apply_filters( 'parent_wpdevart_child_wp_support_url', esc_url('https://wordpress.org/support/theme/jewstore')); ?>" class="button button-secondary getting-started-main-button"><?php esc_html_e( 'Support Forum', 'jewstore' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Hire a Developer', 'jewstore' ); ?></h2>
				<p><?php esc_html_e( 'Hire WordPress developers from WpDevArt and you will get a quick and flexible solution at cost-effective rates. Our WordPress experts will help you to solve any problem. We provide different services for WordPress – website customization and development, theme/plugin customization and development, SEO optimization, WordPress integration, website speed optimization, etc. Our experts have over 10 years of experience, so a high-quality job is guaranteed.', 'jewstore' ) ?></p>
				<p><a target="_blank" href="<?php echo esc_url('https://wpdevart.com/hire-wordpress-developer-dedicated-experts-are-ready-to-help/'); ?>" class="button button-secondary getting-started-main-button getting-started-focus-button"><?php esc_html_e( 'Check Details', 'jewstore' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Best Offer', 'jewstore' ); ?></h2>
				<p><?php esc_html_e( 'On the Best Offer page, you can check the best deals that our company suggests. At this moment we have 15 powerful and useful WordPress plugins and 15+ well-designed and unique themes. These plugins and themes will help you add various features to your WordPress site and improve its appearance. We decided to collect all plugins and themes in one package and take more than 73.99% of the price. You can find more detailed information on our website.', 'jewstore' ) ?></p>
				<p><a target="_blank" href="<?php echo esc_url('https://wpdevart.com/the-best-offer-from-wpdevart/'); ?>" class="button button-secondary getting-started-main-button getting-started-focus-button"><?php esc_html_e( 'Check Details', 'jewstore' ); ?></a></p>
			</div>
		</div>
	<?php
	}
}

function wpdevart_jewstore_free_vs_pro() {
	if ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap wpdevart-vs-table">
			<p class="about-description"><?php esc_html_e( 'Check out some of the differences between the free and premium versions below:', 'jewstore' ); ?></p>
			<div class="wpdevart-vs-theme-table">
				<table>
					<thead>
						<tr><th scope="col"></th>
							<th class="head" scope="col"><?php esc_html_e( 'Free Version', 'jewstore' ); ?></th>
							<th class="head" scope="col"><?php esc_html_e( 'Pro Version', 'jewstore' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Fully Responsive Design', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Integrated with WooCommerce', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Optimized PageSpeed and Clear Codding', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Customizable Top Bar and Header', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><span><?php esc_html_e( 'Homepage Premium Sections', 'jewstore' ); ?></span></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( '+4 Homepage Banner Themes', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Animation Effects', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Wide and Full-width Layouts', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Breadcrumbs', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Customizable Header Cart', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Patterns', 'jewstore' ); ?></td>
							<td headers="features" class="feature"><?php esc_html_e( '1', 'jewstore' ); ?></td>
							<td headers="features" class="feature"><?php esc_html_e( '6+', 'jewstore' ); ?></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Sticky Header', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'WooCommerce Search Bar', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'WooCommerce Sales Section', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Banner Animations', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Button Animations', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Preloader', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Footer Themes', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Priority Support', 'jewstore' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td class="feature feature--empty"></td>
							<td class="feature feature--empty"></td>
							<td headers="comp-2" class="td-btn-2"><a class="button button-secondary getting-started-main-button getting-started-focus-button" href="<?php echo apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')); ?>" target="_blank"><?php esc_html_e( 'Go For Premium', 'jewstore' ); ?></a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	<?php
	}
}

function wpdevart_jewstore_changelog_screen() {
	if ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) {
		global $wp_filesystem;
	?>
			<div class="feature-section two-col wpdevart-feature-section">			
				<div class="col card">
					<h2 class="title"><?php esc_html_e( 'How can I display the custom homepage instead of the latest posts on the main page?', 'jewstore' ); ?></h2>
					<p><?php esc_html_e( 'Go to the theme customize page, then in the left menu, click the Custom Homepage section, go to the Enable Custom Homepage section, and enable the option. Important: You will need to make sure that on the theme Customize page under the Homepage Settings section, the “Your homepage displays” option is set to “Your latest posts.”', 'jewstore' ) ?></p>
				</div>
				<div class="col card">
					<h2 class="title"><?php esc_html_e( 'How can I add widgets to the WooCommerce sidebar?', 'jewstore' ); ?></h2>
					<p><?php esc_html_e( 'You need to go to Appearance > Widgets page, find the WooCommerce Sidebar widget and add the widgets you want.', 'jewstore' ) ?></p>
				</div>
				<div class="col card">
					<h2 class="title"><?php esc_html_e( 'What is the difference between the Primary Button and the header/banner/search page and other buttons?', 'jewstore' ); ?></h2>
					<p><?php esc_html_e( 'The Primary Button is the style of the widget search button and the comments submit button and you can set a custom color for it, while the other buttons are placed on different settings pages and you can choose the color for these buttons from the 10 available colors.', 'jewstore' ) ?></p>
				</div>
				<div class="col card">
					<h2 class="title"><?php esc_html_e( 'What should I do if after successful payment I did not receive a link to download the premium version?', 'jewstore' ); ?></h2>
					<p><?php esc_html_e( 'You need to contact us using the form on the Contact Us page of our website.', 'jewstore' ) ?></p>
				</div>
				<div class="col card">
					<h2 class="title"><?php esc_html_e( 'Can I use animated elements in the free version?', 'jewstore' ); ?></h2>
					<p><?php esc_html_e( 'The animation feature is only available in the premium version, so you need to purchase a theme to use it.', 'jewstore' ) ?></p>
				</div>
			</div>
	<?php
	}
}