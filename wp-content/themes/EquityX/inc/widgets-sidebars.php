<?php
/**
 * Widgets and Sidebars
 *
 * WordPress Widgets add content and features to your Sidebars. Examples are
 * the default widgets that come with WordPress; for post categories, tag
 * clouds, navigation, search, etc.
 *
 * Sidebar is a theme feature introduced with Version 2.2. It's basically a
 * vertical column provided by a theme for displaying information other than
 * the main content of the web page. Themes usually provide at least one
 * sidebar at the left or right of the content. Sidebars usually contain
 * widgets that an administrator of the site can customize.
 *
 * @link       https://codex.wordpress.org/WordPress_Widgets
 * @link       https://codex.wordpress.org/Widgets_API
 * @link       https://codex.wordpress.org/Sidebars
 *
 * @package    WordPress
 * @subpackage EquityX-Theme
 */

if ( function_exists( 'register_sidebar' ) ) {
	/**
	 * Add Widget.
	 */
	function w4ptheme_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar Widgets', 'EquityX' ),
			'id'            => 'sidebar-primary',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Sidebar Footer', 'EquityX' ),
			'id'            => 'sidebar-footer',
			'before_widget' => '<section class="row column footer-text">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Join Us Footer', 'EquityX' ),
			'id'            => 'join-us-footer',
			'before_widget' => '<section class="joinUsSection">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="u-text--center">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Homepage Intro Section', 'EquityX' ),
			'id'            => 'intro-section',
			'before_widget' => '<section class="row column">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Template Intro Section', 'EquityX' ),
			'id'            => 'template-intro-section',
			'before_widget' => '<section class="row column">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => __( 'Small Join Us', 'EquityX' ),
			'id'            => 'join-us-small',
			'before_widget' => '<section class="u-clearfix smallJoinUsSection">',
			'after_widget'  => '</section>',
			'before_title'  => '<p class="smallJoinUsSection-title">',
			'after_title'   => '</p>',
		) );

		register_widget( 'W4P_Contacts_Widget' );
		register_widget( 'W4P_Social_Profiles_Widget' );
		register_widget( 'Join_Us_Button_Widget' );
		register_widget( 'Homepage_Intro_Section_Widget' );
		register_widget( 'Join_Us_White_Button_Widget' );
		register_widget( 'Posts_By_Authors_Widget' );
		register_widget( 'Popular_Posts_Widget' );

	}

	add_action( 'widgets_init', 'w4ptheme_widgets_init' );
}

/**
 * W4P Contacts Widget Class
 */
class W4P_Contacts_Widget extends WP_Widget {


	function __construct() {
		parent::__construct( false,
			$name = __( '[W4P] Contacts', 'EquityX' ) );
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget( $args, $instance ) {
		extract( $args );
		$title       = apply_filters( 'widget_title',
			$instance['title'] ); /* The widget title. */
		$items       = $instance['items'];
		$phone_url   = $instance['phone_url'];
		$skype_url   = $instance['skype_url'];
		$item_titles = $instance['item_titles'];
		$address     = get_option( 'w4p_contacts_address' );
		$phones      = get_option( 'w4p_contacts_phones' );
		$skype       = get_option( 'w4p_contacts_skype' );
		echo $before_widget; ?>

		<?php if ( $title ) {
			echo $before_title . $title . $after_title;
		} ?>
		<?php
		if ( ! empty( $address ) || ! empty( $phones ) || ! empty( $skype ) ) {
			?>
			<ul class="contacts-list">
				<?php
				foreach ( $items as $item ) {
					switch ( $item ) {
						case 'address':
							if ( ! empty( $address ) ) {
								?>
								<li>
									<?php if ( ! empty( $item_titles ) ) : ?>
										<h4><?php esc_html_e( 'Address:',
												'EquityX' ); ?></h4>
									<?php endif; ?>
									<?php echo esc_html( $address ); ?>
								</li>
							<?php
							}
							break;
						case 'phones':
							if ( ! empty( $phones ) ) {
								?>
								<li>
									<?php
									if ( ! empty( $item_titles ) ) : ?>
										<h4><?php esc_html_e( 'Phones:',
												'EquityX' ); ?></h4>
									<?php endif;
									foreach (
										explode( ',', $phones ) as $phone
									) {
										if ( ! empty( $phone ) ) {
											?>
											<?php if ( ! empty( $phone_url ) ) : ?>
												<a href="tel:<?php echo esc_attr( trim( $phone ) ); ?>"><?php echo esc_html( trim( $phone ) ); ?></a>&nbsp;
											<?php else : ?>
												<?php echo esc_html( trim( $phone ) ); ?>&nbsp;
											<?php endif; ?>
										<?php
										}
									} ?>
								</li>
							<?php
							}
							break;
						case 'skype':
							if ( ! empty( $skype ) ) : ?>
								<li>
									<?php if ( ! empty( $item_titles ) ) : ?>
										<h4><?php esc_html_e( 'Skype:',
												'EquityX' ); ?></h4>
									<?php endif; ?>
									<?php if ( ! empty( $skype_url ) ) : ?>
										<a href="skype:<?php echo esc_attr( $skype ); ?>"><?php echo esc_html( $skype ); ?></a>&nbsp;
									<?php else : ?>
										<?php echo esc_html( $skype ); ?>
									<?php endif; ?>
								</li>
							<?php endif; ?>
							<?php break;
					} ?>
				<?php } ?>
			</ul>
		<?php
		}
		echo $after_widget;
	}

	/** @see WP_Widget::update -- do not rename this */
	function update( $new_instance, $old_instance ) {
		$instance                = $old_instance;
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['items']       = $new_instance['items'];
		$instance['item_titles'] = $new_instance['item_titles'];
		$instance['phone_url']   = $new_instance['phone_url'];
		$instance['skype_url']   = $new_instance['skype_url'];

		return $instance;
	}

	/** @see WP_Widget::form -- do not rename this */
	function form( $instance ) {
		$item_list = array(
			'Address' => 'address',
			'Phones'  => 'phones',
			'Skype'   => 'skype',
		);
		// Set up some default widget settings.
		$defaults = array(
			'title'       => __( 'Contacts', 'EquityX' ),
			'items'       => array(),
			'skype_url'   => true,
			'phone_url'   => true,
			'item_titles' => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Get widget fields values.
		if ( ! empty( $instance ) ) {
			$title       = esc_attr( $instance['title'] );
			$items       = $instance['items'];
			$phone_url   = $instance['phone_url'];
			$skype_url   = $instance['skype_url'];
			$item_titles = $instance['item_titles'];
		} ?>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:',
					'EquityX' ); ?></label>
			<input
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>"><?php esc_html_e( 'Choose the Contacts to display:',
					'EquityX' ); ?></label>
			<select
				id="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>"
				class="select-toggle" size="3" multiple="multiple"
				name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[]">
				<?php foreach ( $item_list as $label => $item ) { ?>
					<option <?php echo in_array( $item, (array) $items, true )
						? ' selected="selected" ' : ''; ?>
						value="<?php echo esc_attr( $item ); ?>"><?php echo esc_html( $label ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $item_titles,
				'on' ); ?>
			       id="<?php echo esc_attr( $this->get_field_id( 'item_titles' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'item_titles' ) ); ?>"/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'item_titles' ) ); ?>"><?php esc_html_e( 'Display item titles',
					'EquityX' ) ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $phone_url,
				'on' ); ?>
			       id="<?php echo esc_attr( $this->get_field_id( 'phone_url' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'phone_url' ) ); ?>"/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'phone_url' ) ); ?>"><?php esc_html_e( 'Phones as URL',
					'EquityX' ) ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $skype_url,
				'on' ); ?>
			       id="<?php echo esc_attr( $this->get_field_id( 'skype_url' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'skype_url' ) ); ?>"/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'skype_url' ) ); ?>"><?php esc_html_e( 'Skype as URL',
					'EquityX' ) ?></label>
		</p>
	<?php
	}
} /* End class W4P_Contacts_Widget. */

/**
 * W4P Social Profiles Widget Class
 */
class W4P_Social_Profiles_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( false,
			$name = __( '[W4P] Social Profiles', 'EquityX' ) );
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title',
			$instance['title'] ); /* The widget title. */
		$items = $instance['items'];
		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		$social_profiles = get_option( 'w4p_social_profiles' );
		if ( ! empty( $items ) && ! empty( $social_profiles ) ) {
			$social_profile_index = array();
			foreach ( (array) $social_profiles as $name => $element ) {
				foreach ( $element as $index => $value ) {
					array_push( $social_profile_index, $name . '_' . $index );
				}
			} ?>
			<ul class="social-profile-list">
				<?php
				foreach ( (array) $social_profiles as $name => $element ) {
					foreach ( $element as $index => $value ) {
						?>
						<?php if ( in_array( (string) ( $name . '_' . $index ),
							(array) $items, true ) ) { ?>
							<li>
								<a class="<?php echo esc_attr( $name ); ?>"
								   href="<?php echo esc_url( $value ) ?>"><?php echo esc_html( $name ); ?></a>
							</li>
						<?php } ?>
					<?php
					}
				} ?>
			</ul>
		<?php
		}
		echo $after_widget;
	}

	/** @see WP_Widget::update -- do not rename this */
	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items'] = $new_instance['items'];

		return $instance;
	}

	/** @see WP_Widget::form -- do not rename this */
	function form( $instance ) {
		// Set up some default widget settings.
		$defaults = array(
			'title' => __( 'Social Profiles', 'EquityX' ),
			'items' => array()
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Get widget fields values.
		if ( ! empty( $instance ) ) {
			$title = esc_attr( $instance['title'] );
			$items = $instance['items'];
		}
		$social_profiles      = get_option( 'w4p_social_profiles' );
		$social_profile_index = array();
		if ( ! empty( $social_profiles ) ) {
			foreach ( (array) $social_profiles as $name => $element ) {
				foreach ( $element as $index => $value ) {
					array_push( $social_profile_index, $name . '_' . $index );
				}
			}
		} ?>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:',
					'EquityX' ); ?></label>
			<input
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>"><?php esc_html_e( 'Choose the Social Profiles to display:',
					'EquityX' ); ?></label><br>
			<select
				id="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>"
				class="select-toggle"
				size="<?php echo count( $social_profile_index ); ?>"
				multiple="multiple"
				name="<?php echo esc_attr( $this->get_field_name( 'items' ) ); ?>[]"
				style="min-width: 150px;">
				<?php
				if ( ! empty( $social_profiles ) ) {
					foreach ( (array) $social_profiles as $name => $element ) {
						foreach ( $element as $index => $value ) {
							?>
							<option
								<?php echo in_array( (string) ( $name . '_'
								                                . $index ),
									(array) $items, true )
									? ' selected="selected" ' : ''; ?>
								value="<?php echo esc_attr( $name . '_'
								                            . $index ); ?>"
								tooltip="<?php echo esc_attr( $value ); ?>"
								title="<?php echo esc_attr( $value ); ?>"
								><?php echo esc_html( ucfirst( $name ) ); ?>
							</option>
						<?php
						}
					}
				} ?>
			</select>
		</p>
	<?php
	}
} /* End class W4P_Contacts_Widget. */

class Join_Us_Button_Widget extends WP_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct(
			'join_us_widget', // Base ID
			$name = __( 'Join Us Button Widget', 'EquityX' ), // Name
			array(
				'description' => __( 'Displays Join Us Button Widget.',
					'EquityX' )
			) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title          = apply_filters( 'widget_title', $instance['title'] ); /* The widget title. */
		$login_linkedin = $instance['login_linkedin'];
		$login_facebook = $instance['login_facebook'];
		$login_google   = $instance['login_google'];


		echo $args['before_widget']; ?>

		<div class="u-text--center joinUsWidget">
			<?php if( ! empty( $_GET ) ) :
				$get_request = '/?';
				$get_request .= http_build_query( $_GET ) . "\n";
				?>
				<?php if( $_GET['utm_source'] == 'invitation' && $_GET['utm_medium'] == 'email' && $_GET['utm_campaign'] == 'admin-invite' ) : ?>
					<?php if ( $login_facebook ) : ?>
						<a href="<?php echo $login_facebook . $get_request; ?>" class="btn btn--hasIcon btn--facebook" title="Connect with Facebook">
								<span class="btn-icon">
									<svg class="svgIcon btn-icon-svgFacebook">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fillfacebook"></use>
									</svg>
								</span>
							<?php _e( 'Connect with Facebook', 'EquityX' ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $login_google ) : ?>
						<a href="<?php echo $login_google . $get_request; ?>" class="btn btn--hasIcon btn--google" title="Connect with Google">
							<span class="btn-icon">
								<svg class="svgIcon btn-icon-svgGoogle">
									<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fillgoogle"></use>
								</svg>
							</span>
							<?php _e( 'Connect with Google', 'EquityX' ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $login_linkedin ) : ?>
						<a href="<?php echo $login_linkedin . $get_request; ?>" class="btn btn--hasIcon btn--linkedIn" title="Connect with LinkedIn">
							<span class="btn-icon">
								<svg class="svgIcon btn-icon-svgLinkedin">
									<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#linkedin"></use>
								</svg>
							</span>
							<?php _e( 'Connect with LinkedIn', 'EquityX' ); ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>
				<?php else : ?>
					<?php if ( $login_facebook ) : ?>
						<a href="<?php echo $login_facebook; ?>" class="btn btn--hasIcon btn--facebook" title="Connect with Facebook">
								<span class="btn-icon">
									<svg class="svgIcon btn-icon-svgFacebook">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fillfacebook"></use>
									</svg>
								</span>
							<?php _e( 'Connect with Facebook', 'EquityX' ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $login_google ) : ?>
						<a href="<?php echo $login_google; ?>" class="btn btn--hasIcon btn--google" title="Connect with Google">
							<span class="btn-icon">
								<svg class="svgIcon btn-icon-svgGoogle">
									<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fillgoogle"></use>
								</svg>
							</span>
							<?php _e( 'Connect with Google', 'EquityX' ); ?>
						</a>
					<?php endif; ?>
					<?php if ( $login_linkedin ) : ?>
						<a href="<?php echo $login_linkedin; ?>" class="btn btn--hasIcon btn--linkedIn" title="Connect with LinkedIn">
							<span class="btn-icon">
								<svg class="svgIcon btn-icon-svgLinkedin">
									<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#linkedin"></use>
								</svg>
							</span>
							<?php _e( 'Connect with LinkedIn', 'EquityX' ); ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>
		</div>
		<?php
		echo $args['after_widget'];

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                   = array();
		$instance['title']          = get_field( 'title', 'widget_' . $this->id );
		$instance['login_linkedin'] = get_field( 'login_linkedin', 'widget_' . $this->id );
		$instance['login_facebook'] = get_field( 'login_facebook', 'widget_' . $this->id );
		$instance['login_google']   = get_field( 'login_google', 'widget_' . $this->id );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	}

}

class Join_Us_White_Button_Widget extends WP_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct(
			'white_button_widget', // Base ID
			$name = __( 'White Join Us Button Widget', 'EquityX' ), // Name
			array(
				'description' => __( 'Displays Join Us White Button.',
					'EquityX' )
			) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title         = apply_filters( 'widget_title', $instance['title'] ); /* The widget title. */
		$login_linkedin = $instance['login_linkedin'];
		$login_facebook = $instance['login_facebook'];
		$login_google   = $instance['login_google'];


		echo $args['before_widget']; ?>

		<div class="u-text--center joinUsWidget joinUsWidget--small">
			<a href="#login-popup" class="btn js-loginPopup" title="<?php _e( 'join us!', 'EquityX' ); ?>">
				<?php _e( 'join us!', 'EquityX' ); ?>
			</a>
		</div>

		<?php
		echo $args['after_widget'];

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                  = array();
		$instance['title']         = get_field( 'button_title', 'widget_' . $this->id );
		$instance['login_linkedin'] = get_field( 'login_linkedin', 'widget_' . $this->id );
		$instance['login_facebook'] = get_field( 'login_facebook', 'widget_' . $this->id );
		$instance['login_google']   = get_field( 'login_google', 'widget_' . $this->id );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	}

}

/**
 * Intro Section Widget
 */
class Homepage_Intro_Section_Widget extends WP_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct(
			'intro_section_widget', // Base ID
			$name = __( 'Homepage Intro Section Widget', 'EquityX' ), // Name
			array(
				'description' => __( 'Displays Homepage Intro Section Widget.',
					'EquityX' )
			) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$intro_title       = apply_filters( 'widget_title', $instance['intro_title'] );
		$intro_duration       = $instance['video_duration'];
		$intro_description = $instance['intro_description'];
		$intro_video_url   = $instance['intro_video_url'];
		$intro_video_caption = $instance['video_caption'];



		echo $args['before_widget']; ?>

		<?php
		if ( isset( get_option( 'w4p_social_profiles' )['login_linkedin'][1] ) ) {
			$login_linkedin = get_option( 'w4p_social_profiles' )['login_linkedin'][1];
		} else {
			$login_linkedin = '';
		}
		if ( isset( get_option( 'w4p_social_profiles' )['login_facebook'][1] ) ) {
			$login_facebook = get_option( 'w4p_social_profiles' )['login_facebook'][1];
		} else {
			$login_facebook = '';
		}
		if ( isset( get_option( 'w4p_social_profiles' )['login_google'][1] ) ) {
			$login_google = get_option( 'w4p_social_profiles' )['login_google'][1];
		} else {
			$login_google = '';
		}
		?>

		<div class="intro_section_widget introSection">
			<h1 class="introSection-title"><?php echo $intro_title; ?></h1>
			<div class="introSection-description"><?php echo $intro_description; ?></div>
			<?php if (!empty($intro_video_url)): ?>
				<div class="introSection-video">
					<a href="#video-popup" class="js-videoBox introSection-video-trigger">
						<span class="introSection-video-trigger-icon"></span>
						<img src="<?php echo $intro_video_caption; ?>" alt="">
					</a>
				</div>
			<?php endif; ?>
			<div class="introSection-social">
				<a href="#login-popup" class="btn js-loginPopup" title="<?php _e( 'join us!', 'EquityX' ); ?>">
					<?php _e( 'join us!', 'EquityX' ); ?>
				</a>
			</div>

			<div id="video-popup" class="introSection-popup mfp-hide">
				<div class="mfp-iframe-scaler">
					<iframe src="<?php echo $intro_video_url ?>" frameborder="0" allowfullscreen class="js-video-iFrame"></iframe>
				</div>
			</div>
		</div>

		<?php
		echo $args['after_widget'];

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                      = array();
		$instance['intro_title']       = get_field( 'intro_title', 'widget_' . $this->id );
		$instance['video_duration']       = get_field( 'video_duration', 'widget_' . $this->id );
		$instance['intro_description'] = get_field( 'intro_description', 'widget_' . $this->id );
		$instance['intro_video_url']   = get_field( 'intro_video_url', 'widget_' . $this->id );
		$instance['video_caption']   = get_field( 'video_caption', 'widget_' . $this->id );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	}

}

/**
 * Popular Posts Widget
 */
class Popular_Posts_Widget extends WP_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct(
			'popular_posts_widget', // Base ID
			$name = __( 'Popular Posts Widget', 'EquityX' ), // Name
			array(
				'description' => __( 'Displays Popular Posts Widget.',
					'EquityX' )
			) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title      = apply_filters( 'widget_title', $instance['title'] );
		$limit  = $instance['limit'];
		$offset     = $limit > 0 ? $limit : 0;

		wp_enqueue_script( 'jquery-mCustomScrollbar', get_template_directory_uri() . '/js/vendor/jquery.mCustomScrollbar.min.js', array( 'jquery' ), NULL, TRUE );
		wp_enqueue_style( 'style-mCustomScrollbar', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.min.css' );

		echo $args['before_widget']; ?>

		<div class="widgetItem popularPosts js-popularPosts">
			<h1 class="widgetItem-title"><?php esc_html_e( $title ); ?></h1>
			<ul class="u-list--plain popularPosts-postHolder js-popularScrollArea">
				<?php echo do_shortcode( "[popular-posts limit='{$limit}' offset='0']" ); ?>
			</ul>
			<?php if ( $limit <> -1 ) : ?>
				<a
					href="<?php echo esc_attr( "/?offset={$offset}&limit={$limit}" ); ?>"
					class="popularPosts-more js-popularMore"
				>
					<span>
						<?php esc_html_e( 'View more', 'EquityX' ); ?>
					</span>
				</a>
			<?php endif; ?>
		</div>

		<?php
		echo $args['after_widget'];

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance               = array();
		$instance['title']      = apply_filters( 'widget_title', $new_instance['title'] );
		$instance['limit']  = $new_instance['limit'];

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		// Set up some default widget settings.
		$defaults = array(
			'title' => __( 'Popular Posts', 'EquityX' ),
			'limit' => 5,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Get widget fields values.
		if ( ! empty( $instance ) ) {
			$title = esc_attr( $instance['title'] );
			$limit = $instance['limit'];
		}
		$limit_list = array(
			1 => '1',
			2 => '2',
			5 => '5',
			7 => '7',
			10 => '10',
			12 => '12',
			15 => '15',
			17 => '17',
			20 => '20',
			50 => '50',
			-1 => __( '--All--', 'EquityX' ),
		); ?>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:',
					'EquityX' ); ?></label>
			<input
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php esc_html_e( 'Choose amount of posts to show:',
					'EquityX' ); ?></label><br>
			<select
				id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>"
				style="min-width: 150px;">
				<?php
				foreach( $limit_list as $value => $label) { ?>
					<option
						<?php selected( $limit, $value ) ?>
						value="<?php echo esc_attr( $value ); ?>"
					>
						<?php echo esc_html( $label ); ?>
					</option>
				<?php } ?>
			</select>
		</p>
		<?php
	}

}
/**
 * Posts By Authors Widget
 */
class Posts_By_Authors_Widget extends WP_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct(
			'posts_by_authors_widget', // Base ID
			$name = __( 'Posts By Authors', 'EquityX' ), // Name
			array(
				'description' => __( 'Filters Blog Posts by selected author.',
					'EquityX' )
			) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$limit  = $instance['limit'];

		echo $args['before_widget']; ?>
		<div class="posts_by_authors_widget posts-by-authors widgetItem authorFilter">
			<h1 class="widgetItem-title"><?php echo $title; ?></h1>
			<?php
			// Getting posts from database with WP_Query.
			$query_args = array(
				'post_type'           => 'post_author',
				'post_status'         => 'publish',
				'posts_per_page'      => $limit,
				'ignore_sticky_posts' => true,
				'orderby'             => array( 'title' => 'ASC' ),
			);
			$loop = new WP_Query( $query_args );

			// If count of posts is greater then 0, starting to print posts content on page.
			if ( ! empty( $loop ) && $loop->post_count ) : ?>
				<ul class="u-list--plain">
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<li class="authorFilter-item">
							<a href="<?php echo add_query_arg('post_author_meta', get_the_ID(), get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="authorFilter-item-picture">
								<?php echo wp_get_attachment_image( get_field('author_picture'), 'logo_150_111' ); ?>
							</a>
							<div class="authorFilter-item-content">
								<a href="<?php echo add_query_arg('post_author_meta', get_the_ID(), get_permalink( get_option( 'page_for_posts' ) ) ); ?>">
									<?php the_title(); ?>
								</a>
								<span>
									<?php
									$term = get_term( get_field( 'author_position', false ), 'position' );
									if ( $term ) {
										echo $term->name;
									} ?>
								</span>
							</div>
						</li>

					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				</ul>
			<?php endif; ?>

		</div>

		<?php
		echo $args['after_widget'];

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = apply_filters( 'widget_title', $new_instance['title'] );
		$instance['limit'] = $new_instance['limit'];

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		// Set up some default widget settings.
		$defaults = array(
			'title' => __( 'Posts By Authors', 'EquityX' ),
			'limit' => 5,
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		// Get widget fields values.
		if ( ! empty( $instance ) ) {
			$title = esc_attr( $instance['title'] );
			$limit = $instance['limit'];
		}
		$limit_list = array(
			1   => '1',
			2   => '2',
			5   => '5',
			7   => '7',
			10  => '10',
			12  => '12',
			15  => '15',
			17  => '17',
			20  => '20',
			50  => '50',
			- 1 => __( '--All--', 'EquityX' ),
		); ?>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:',
					'EquityX' ); ?></label>
			<input
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php esc_html_e( 'Choose amount of authors to show:',
					'EquityX' ); ?></label><br>
			<select
				id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>"
				style="min-width: 150px;">
				<?php
				foreach ( $limit_list as $value => $label ) {
					?>
					<option
						<?php selected( $limit, $value ) ?>
						value="<?php echo esc_attr( $value ); ?>"
					>
						<?php echo esc_html( $label ); ?>
					</option>
				<?php } ?>
			</select>
		</p>
		<?php
	}

}

