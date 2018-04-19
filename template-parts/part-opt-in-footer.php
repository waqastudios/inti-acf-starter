<?php
	// get the id of the opt in 
	$optin_id = get_inti_option('footer_opt_in', 'inti_customizer_options', '-1');

	//fetch the opt in
	$optin_object = get_post($optin_id);

	if($optin_object && $optin_object->post_type == "inti-opt-in" && $optin_object->post_status == "publish") :

		// get its meta
		$action = get_field('url', $optin_id);
		$target = get_field('target', $optin_id);
		$hidden = get_field('hidden', $optin_id);
		$button_text = get_field('button_text', $optin_id);
		$button_name = get_field('button_name', $optin_id);
		$form_name = get_field('form_element_name', $optin_id);

		$first_name_name = get_field('first_name_name', $optin_id);
		$first_name_placeholder = get_field('first_name_placeholder', $optin_id);
		$first_name_required = get_field('first_name_required', $optin_id);

		$email_name = get_field('email_name', $optin_id);
		$email_placeholder = get_field('email_placeholder', $optin_id);
		$email_required = get_field('email_required', $optin_id);

?>
		<section class="opt-in footer">
			<div class="grid-container">
				<div class="grid-x grid-margin-x">
					<div class="small-12 medium-6 mlarge-5 cell">
						<div class="opt-in-lead-in">
							<?php echo wpautop(do_shortcode($optin_object->post_content)); ?>
						</div>
					</div>
					<div class="small-12 medium-6 mlarge-7 cell">

						<form action="<?php echo $action; ?>" method="post" id="footer-opt-in" name="<?php if ($form_name) : echo $form_name; else : echo "form-" . $optin_object->ID; endif; ?>" <?php if ($target) echo 'target="_blank"'; ?>>
							<div class="hide">
								<?php echo stripslashes($hidden); ?>
							</div>

							<fieldset>
								<div class="grid-x">
									<div class="medium-6 mlarge-4 cell">
										<input type="text" name="<?php echo $first_name_name; ?>" id="footer-opt-in-<?php echo $first_name_name; ?>" placeholder="<?php echo $first_name_placeholder; ?>" class=""<?php if ($first_name_required) echo ' required'; ?>>
									</div>
									<div class="medium-6 mlarge-4 cell">
										<input type="email" name="<?php echo $email_name; ?>" id="footer-opt-in-<?php echo $email_name; ?>" placeholder="<?php echo $email_placeholder; ?>" class=""<?php if ($email_required) echo ' required'; ?>>
									</div>
									<div class="medium-12 mlarge-4 cell">
										<input type="submit" value="<?php echo $button_text ?>" name="<?php echo $button_name; ?>" id="submit-<?php echo $button_name; ?>" class="button expanded">
									</div>
								</div>
							</fieldset>
						</form>

					</div>
				</div>
			</div>
		</section>

<?php endif; ?>