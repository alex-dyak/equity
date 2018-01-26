<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>


<form id="equityx_form" class="equityx-custom-form js-equityx-form" method="post">
	<?php if( $first_name ) : ?>
		<label for="first_name"><?php _e( 'First Name', 'EquityX' ); ?></label>
		<input id="first_name" type="text" name="first_name" required="required">
	<?php endif; ?>
	<?php if( $last_name ) : ?>
		<label for="last_name"><?php _e( 'Last Name', 'EquityX' ); ?></label>
		<input id="last_name" type="text" name="last_name" required="required">
	<?php endif; ?>
	<?php if( $company ) : ?>
		<label for="company"><?php _e( 'Company', 'EquityX' ); ?></label>
		<input id="company" type="text" name="company" required="required">
	<?php endif; ?>
	<?php if( $email ) : ?>
		<label for="email"><?php _e( 'Email', 'EquityX' ); ?></label>
		<input id="email" type="email" name="email" required="required">
	<?php endif; ?>
	<?php if( $who_are_you ) : ?>
		<label for="who_are_you"><?php _e( 'I am a:', 'EquityX' ); ?></label>
		<input type="radio" name="who_are_you" VALUE="expert"><?php _e( 'Industry expert', 'EquityX' ); ?>
		<input type="radio" name="who_are_you" VALUE="investor"><?php _e( 'Investor', 'EquityX' ); ?>
		<input type="radio" name="who_are_you" VALUE="startup"><?php _e( 'Startup', 'EquityX' ); ?>
		<input type="radio" name="who_are_you" VALUE="other"><?php _e( 'Other..', 'EquityX' ); ?>
	<?php endif; ?>
	<input type="hidden" name="action" value="equityx_form_action" />
	<?php echo wp_nonce_field( 'equityx_form_action', '_acf_nonce', true, false ); ?>
	<input type="hidden" name="mail_to" value="<?php echo $mail_to; ?>">
	<input type="hidden" name="mail_subject" value="<?php echo $mail_subject; ?>">
	<input type="button" id="contactbutton" class="submit" name="submit" value="<?php echo $submit_text ? $submit_text : 'Submit'; ?>">
	<div id="contact-msg"></div>
</form>
