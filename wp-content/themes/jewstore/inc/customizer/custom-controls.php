<?php

##################------ Custom controls ------##################

if ( class_exists( 'WP_Customize_Control' ) ) {

	class wpdevart_jewstore_Section_Premium extends WP_Customize_Section {

		public $type = 'wpdevart-buy-premium';
		public $pro_text = '';
		public $pro_url = '';
		public function json() {
			$json = parent::json();
			$json['pro_text'] = $this->pro_text;
			$json['pro_url']  = esc_url( $this->pro_url );
			return $json;
		}

		protected function render_template() { ?>
			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<h3 class="accordion-section-title">
					{{ data.title }}
					<# if ( data.pro_text && data.pro_url ) { #>
						<a href="{{ data.pro_url }}" class="wpdevart-premium-action-button wpdevart-pro-button-style" target="_blank">{{ data.pro_text }}</a>
					<# } #>
				</h3>
			</li>
		<?php }
	}
    
	class Wpdevart_Toggle_Switch_Custom_control extends WP_Customize_Control {
		public $type = 'wpdevart_jewstore_toggle_switch';
		public function enqueue(){
			wp_enqueue_style( 'wpdevart-theme-custom-controls', get_template_directory_uri().'/inc/customizer/css/customizer.css');
            wp_enqueue_script('wpdevart-customizer-js', get_theme_file_uri('/inc/customizer/js/customizer.js'), array('jquery'), '1.0', true);
		}
		public function render_content(){
		?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
	}

    class Wpdevart_Slider_Custom_Control extends WP_Customize_Control {
		public $type = 'wpdevart_jewstore_slider_control';
		public function render_content() {
		?>
			<div class="slider-custom-control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
				<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
			</div>
		<?php
		}
	}

    class Wpdevart_Image_Radio_Button_Custom_Control extends WP_Customize_Control {
		public $type = 'wpdevart_jewstore_image_radio_button';
		public function render_content() {
		?>
			<div class="image_radio_button_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<?php foreach ( $this->choices as $key => $value ) { ?>
					<label class="radio-button-label">
						<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
						<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
					</label>
				<?php	} ?>
			</div>
		<?php
		}
	}

	class Wpdevart_Premium_Features_List extends WP_Customize_Section {

		public $type              = 'section-features-list';
		public $premium_features_list     = array();
		public $upsell_link       = '';
		public $upsell_text       = '';
		public $button_link       = '';
		public $button_text       = '';
	
		public function json() {
			$json = parent::json();
	
			$json['title']             = $this->title;
			$json['premium_features_list']     = $this->premium_features_list;
			$json['upsell_link']       = $this->upsell_link;
			$json['upsell_text']       = __( 'Upgrade Now', 'jewstore' );
			$json['button_link']       = $this->button_link;
			$json['button_text']       = $this->button_text;
	
			return $json;
		}
	
		protected function render_template() {
			?>
				<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} {{data.class}}">
					<# if ( data.title ) { #>
						<h3>{{ data.title }}</h3>
					<# } #>
					<# if ( !_.isEmpty(data.premium_features_list) ) { #>
						<ul class="wpdevart-premium-features-list">
							<# _.each( data.premium_features_list, function(key, value) { #>
								<li><span class="dashicons dashicons-yes"></span>{{{ key }}}</li>
							<# }) #>
						</ul>
					<# } #>
					<a href="{{ data.upsell_link }}" role="button" class="wpdevart-features-button-style" target="_blank">{{ data.upsell_text }}</a>
				</li>
			<?php
		}
	}

	class Wpdevart_Premium_Features_Control_List extends WP_Customize_Control {

		public $type = 'control_wpdevart_jewstore_premium_features';
		public function render_content() {
			?>
				<div class="control-section-section-features-list">
					<?php if( !empty( $this->label ) ) { ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php } ?>

					<ul class="wpdevart-premium-features-list">
						<?php foreach ( $this->choices as $key => $value ) { ?>
							<li><span class="dashicons dashicons-yes"></span><?php echo esc_html( $value['name'] ); ?></li>
						<?php	} ?>
					</ul>

					<a href="<?php echo apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')); ?>" role="button" class="wpdevart-features-button-style" target="_blank"><?php echo esc_html__( 'Upgrade Now', 'jewstore' ); ?></a>
				</div>	
			<?php
		}
	}	

}