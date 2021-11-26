if ($translator_of_the_month) {
												
												?>
						
												<div class="get-to-know-us__element-wrapper wrapper-flex-col-center">
						
													<p class="text--blue fs--1200 fw--700 mb--5">
													<?php echo $section_6_title_2 ?>
													</p>
						
													<div class="translator__top">
						
														<a class="wrapper-flex-col-center mb--2" href="<?php echo get_permalink($translator_of_the_month->ID) ?>">
						
															<div class="profile-picture__wrapper text--center mb--4">
						
																	<div class="corner__decoration corner__decoration--left"></div>
						
																	<img src="<?php echo get_the_post_thumbnail_url($translator_of_the_month->ID) ?>" loading="lazy">
						
																	<div class="corner__decoration corner__decoration--right"></div>
						
															</div>
						
														</a>
						
													</div>
						
													<?php
						
														$management_member_of_the_month = get_field('translator_first_name', $translator_of_the_month->ID);
														$translator_of_the_month_last_name = get_field('translator_last_name', $translator_of_the_month->ID);
						
														echo '<p class="fs--800 fw--700 text--blue text--center mb--2">'.$management_member_of_the_month.' '.$translator_of_the_month_last_name.'</p>';
						
														?>
						
														<div class="flex content-between items-center">
															<div class="flex items-center text--right icons-wrapper">
						
															<?php
						
																$translator_of_the_month_contact_email = get_field('translator_contact_email', $translator_of_the_month->ID);
						
																if ($translator_of_the_month_contact_email)  {
						
																	echo '<a href="mailto:'.esc_url($translator_of_the_month_contact_email).'" class="contact-icon contact-icon__email" target="_blank">
																	'.$email_icon_blue.'
																	</a>';
																}
						
																$translator_of_the_month_linkedin_link = get_field('translator_linkedin_link', $translator_of_the_month->ID);
						
																if ($translator_of_the_month_linkedin_link)  {
						
																	echo '<a href="'.esc_url($translator_of_the_month_linkedin_link).'" class="contact-icon contact-icon__linkedin" target="_blank">
																	'.$linkedin_icon.'
																	</a>';
																}
						
															?>
						
															</div>
						
															<div class="cta-holder text--center">
																<a class="button button__filled--turquoise" href="<?php echo get_permalink($translator_of_the_month->ID) ?>">Profil</a>
															</div>
						
														</div>
												</div>
						
											<?php
											}