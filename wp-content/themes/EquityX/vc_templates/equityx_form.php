<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>


<form id="equityx_form" class="customForm js-equityx-form" method="post">
	<div class="customForm-inputBox">
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
	</div>
	<div class="customForm-checkBox">
		<?php if( $who_are_you ) : ?>
			<p for="who_are_you"><?php _e( 'I am a:', 'EquityX' ); ?></p>
			<label>
				<input type="radio" name="who_are_you" VALUE="Expert">
				<span><?php _e( 'Industry expert', 'EquityX' ); ?></span>
			</label>
			<label>
				<input type="radio" name="who_are_you" VALUE="Investor">
				<span><?php _e( 'Investor', 'EquityX' ); ?></span>
			</label>
			<label>
				<input type="radio" name="who_are_you" VALUE="Startup">
				<span><?php _e( 'Startup', 'EquityX' ); ?></span>
			</label>
			<label>
				<input type="radio" name="who_are_you" VALUE="Other">
				<span><?php _e( 'Other..', 'EquityX' ); ?></span>
			</label>
		<?php endif; ?>
	</div>
	<input type="hidden" name="action" value="equityx_form_action" />
	<?php echo wp_nonce_field( 'equityx_form_action', '_acf_nonce', true, false ); ?>
	<input type="hidden" name="mail_to" value="<?php echo $mail_to; ?>">
	<input type="hidden" name="mail_subject" value="<?php echo $mail_subject; ?>">
	<input type="button" id="contactbutton" class="submit" name="submit" value="<?php echo $submit_text ? $submit_text : 'Submit'; ?>">
	<div id="contact-msg" class="customForm-message"></div>
</form>
