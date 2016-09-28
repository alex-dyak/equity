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
 * @subpackage W4P-Theme
 */

if ( function_exists( 'register_sidebar' ) ) {
	/**
	 * Add Widget.
	 */
	function w4ptheme_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar Widgets', 'w4ptheme' ),
			'id'            => 'sidebar-primary',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Sidebar Footer', 'w4ptheme' ),
			'id'            => 'sidebar-footer',
			'before_widget' => '<section class="row column">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => __( 'Join Us Footer', 'w4ptheme' ),
			'id'            => 'join-us-footer',
			'before_widget' => '<section class="row column">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => __( 'Homepage Intro Section', 'w4ptheme' ),
			'id'            => 'intro-section',
			'before_widget' => '<section class="row column">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );

		register_widget( 'W4P_Contacts_Widget' );
		register_widget( 'W4P_Social_Profiles_Widget' );
		register_widget( 'Join_Us_Button_Widget' );
		register_widget( 'Homepage_Intro_Section_Widget' );

	}

	add_action( 'widgets_init', 'w4ptheme_widgets_init' );
}

/**
 * W4P Contacts Widget Class
 */
class W4P_Contacts_Widget extends WP_Widget {


	function __construct() {
		parent::__construct( false,
			$name = __( '[W4P] Contacts', 'w4ptheme' ) );
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
												'w4ptheme' ); ?></h4>
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
												'w4ptheme' ); ?></h4>
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
												'w4ptheme' ); ?></h4>
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
			'title'       => __( 'Contacts', 'w4ptheme' ),
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
					'w4ptheme' ); ?></label>
			<input
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>"><?php esc_html_e( 'Choose the Contacts to display:',
					'w4ptheme' ); ?></label>
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
					'w4ptheme' ) ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $phone_url,
				'on' ); ?>
			       id="<?php echo esc_attr( $this->get_field_id( 'phone_url' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'phone_url' ) ); ?>"/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'phone_url' ) ); ?>"><?php esc_html_e( 'Phones as URL',
					'w4ptheme' ) ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $skype_url,
				'on' ); ?>
			       id="<?php echo esc_attr( $this->get_field_id( 'skype_url' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'skype_url' ) ); ?>"/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'skype_url' ) ); ?>"><?php esc_html_e( 'Skype as URL',
					'w4ptheme' ) ?></label>
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
			$name = __( '[W4P] Social Profiles', 'w4ptheme' ) );
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
			'title' => __( 'Social Profiles', 'w4ptheme' ),
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
					'w4ptheme' ); ?></label>
			<input
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'items' ) ); ?>"><?php esc_html_e( 'Choose the Social Profiles to display:',
					'w4ptheme' ); ?></label><br>
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
			$name = __( 'Join Us Button Widget', 'w4ptheme' ), // Name
			array(
				'description' => __( 'Displays Join Us Button Widget.',
					'w4ptheme' )
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
		$title         = apply_filters( 'widget_title',
			$instance['title'] ); /* The widget title. */
		$link          = $instance['link'];
		$title_content = $instance['title_content'];
		$content       = $instance['content'];


		echo $args['before_widget']; ?>

		<div class="join-us-widget">
			<a href="<?php echo $link ?>">
				<button class="joinUs-button-in">
					<img class="joinUs-button-in-icon" alt=""
					     src="<?php echo get_template_directory_uri(); ?>/img/icon/linkedin-letters.png">
					<span
						class="joinUs-button-in-text"><?php _e( strtoupper( $title ),
							'w4ptheme' ); ?></span>
				</button>
			</a>
		</div>

		<img class="joinUs-inform" alt=""
		     src="<?php echo get_template_directory_uri(); ?>/img/icon/info-blue.png">
		<div class="joinUs-poupap">
			<div>
				<h5 class="joinUs-poupap-title"><?php _e( strtoupper( $title_content ),
						'w4ptheme' ); ?></h5>
				<span class="joinUs-poupap-text">
					<div
						class="textwidget"><?php echo strip_tags( $content ); ?></div>
				</span>
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
		$instance                  = array();
		$instance['title']         = get_field( 'title', 'widget_' . $this->id );
		$instance['link']          = get_field( 'link', 'widget_' . $this->id );
		$instance['title_content'] = get_field( 'title_content', 'widget_' . $this->id );
		$instance['content']       = get_field( 'content', 'widget_' . $this->id );

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
			$name = __( 'Homepage Intro Section Widget', 'w4ptheme' ), // Name
			array(
				'description' => __( 'Displays Homepage Intro Section Widget.',
					'w4ptheme' )
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
		$intro_image       = $instance['intro_image'];
		$intro_description = $instance['intro_description'];
		$intro_video_url   = $instance['intro_video_url'];



		echo $args['before_widget']; ?>

		<div class="intro_section_widget introSection">
			<h1><?php echo $intro_title; ?></h1>
			<div><?php echo $intro_description; ?></div>
			<img class="joinUs-button-in-icon" alt="" src="<?php echo $intro_image; ?>">
			<a href="<?php echo $intro_video_url ?>">Video Link</a>
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
		$instance['intro_image']       = get_field( 'intro_image', 'widget_' . $this->id );
		$instance['intro_description'] = get_field( 'intro_description', 'widget_' . $this->id );
		$instance['intro_video_url']   = get_field( 'intro_video_url', 'widget_' . $this->id );

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
