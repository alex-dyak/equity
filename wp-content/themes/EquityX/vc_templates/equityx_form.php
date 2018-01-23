<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( ! empty( $_POST ) ) {
	$email_to   = $mail_to ? $mail_to : get_option( 'admin_email' );
	$subject    = $mail_subject ? $mail_subject : '';
	$first_name = $_POST['first_name'] ? $_POST['first_name'] : '';
	$last_name  = $_POST['last_name'] ? $_POST['last_name'] : '';
	$email      = $_POST['email'] ? $_POST['email'] : 'example@example.com';
	$startup    = $_POST['startup'] ? $_POST['startup'] : '';
	$message    = "From: $first_name $last_name < $email >";
	$message   .= '<br/>';
	$message   .= $startup ? 'Startup: ' . $startup : '';
	$headers    = [
		"From: EquityX <wp-contacts@equityx.io>",
		"Reply-To: $email",
		'content-type: text/html',
	];

	wp_mail( $email_to, $subject, $message, $headers );
	$new_post = array(
		'post_title' => $first_name . ' ' . $last_name,
		'author' => $first_name . ' ' . $last_name,
		'post_content' => $message,
		'post_status' => 'publish',
		'post_date' => date('Y-m-d H:i:s'),
		'post_type' => 'form-record',
	);
	$post_id = wp_insert_post($new_post);
	update_post_meta( $post_id, '_equityx_email', $email );
	update_post_meta( $post_id, '_equityx_startup', $startup );
	update_post_meta( $post_id, '_equityx_sender', $first_name . ' ' . $last_name );
}

?>


<form id="equityx_form" class="equityx-custom-form" method="post">
	<?php if( $first_name ) : ?>
		<label for="first_name"><?php _e( 'First Name', 'EquityX' ); ?></label>
		<input id="first_name" type="text" name="first_name" required="required">
	<?php endif; ?>
	<?php if( $last_name ) : ?>
		<label for="last_name"><?php _e( 'Last Name', 'EquityX' ); ?></label>
		<input id="last_name" type="text" name="last_name" required="required">
	<?php endif; ?>
	<?php if( $startup ) : ?>
		<label for="startup"><?php _e( 'Startup', 'EquityX' ); ?></label>
		<input id="startup" type="text" name="startup" required="required">
	<?php endif; ?>
	<?php if( $email ) : ?>
		<label for="email"><?php _e( 'Email', 'EquityX' ); ?></label>
		<input id="email" type="email" name="email" required="required">
	<?php endif; ?>
	<input type="submit" class="submit" value="<?php echo $submit_text ? $submit_text : 'Submit'; ?>">
	<?php wp_nonce_field( 'ajax-form-nonce', 'security' ); ?>
</form>
