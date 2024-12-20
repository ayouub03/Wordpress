<?php
/**
 * Template part for displaying header contact.
 *
 * @since Hello Shoppable 1.0.0
 */

?>
<?php if( enabled_header_sortable_element( 'header_contact_info' ) ){ ?>
	<div class="header-contact">
		<ul>
			<?php if( get_theme_mod( 'enable_contact_phone', false ) ){ ?>
				<li>
					<a href="<?php echo esc_url( 'tel:' . get_theme_mod( 'contact_phone', '' ) ); ?>"><i class="fas fa-phone-alt"></i>
						<span class="sh-contact-phone"><?php echo esc_html( get_theme_mod( 'contact_phone', '' ) ); ?></span>
					</a>
				</li>
			<?php } ?>
			<?php if( get_theme_mod( 'enable_contact_email', false ) ){ ?>
				<li>
					<a href="<?php echo esc_url( 'mailto:' . get_theme_mod( 'contact_email', '' ) ); ?>"><i class="fas fa-envelope"></i>
						<span class="sh-contact-email"><?php echo esc_html( get_theme_mod( 'contact_email', '' ) ); ?></span>
					</a>
				</li>
			<?php } ?>
			<?php if( get_theme_mod( 'enable_contact_address', false ) ){ ?>
				<li>
					<i class="fas fa-map-marker-alt"></i>
					<div class="sh-contact-address"><?php echo esc_html( get_theme_mod( 'contact_address', '' ) ); ?></div>
				</li>
			<?php } ?>
		</ul>
	</div>
<?php } ?>