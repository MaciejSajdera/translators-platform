<?php

								/* PICTURES CONTAINER */

								echo '<div class="info-box pictures-container">';

									echo '<div class="account__box-container">';

										echo '<div class="info-box__header"><p>Zdjęcia i filmy</p></div>';
										
										/* AJAX LOADER */

										echo '<div class="my-ajax-loader">
												<div class="my-ajax-loader__spinner"></div>
												<div class="progress">
													<div class="progress-bar"></div>
													<div class="progress-percents"></div>
												</div>
											</div>';

										/* CONTENT BOX */

										echo '<div class="content-box">';

											echo '<div class="info-box__subbox wrapper-flex-drow-mcol w--full">';

											/* IMAGES GALLERY PANEL */

												echo '<div class="my-pictures__wrapper ajax-content-wrapper col-m100-d50">';
													
													echo '<div class="my-pictures__gallery">';

														/* DYNAMIC MESSAGES CONTENT HOLDER */

														echo '<div class="is-gallery-empty__messages" style="display: none">';
														echo '<p class="is-gallery-empty__yes">Aktualnie nie masz dodanych żadnych zdjęć.</p>';
														echo '<p class="is-gallery-empty__no">Zdjęcia:</p>';
														echo '</div>';

													if ($images_to_gallery_array) {

														echo '<p class="info-box__subbox-header is-gallery-empty__status-text-holder">Zdjęcia</p>';

														foreach ($images_to_gallery_array as $image) :

																if(wp_get_attachment_image_url(attachment_url_to_postid($image))) {

																	echo '<div class="my-pictures__gallery-attachment pb--2 mb--2">';

																		echo '<a class="remove-item" href="#" data-id="'.attachment_url_to_postid($image).'"></a>';

																		echo '<img src="'.wp_get_attachment_image_url(attachment_url_to_postid($image), 'full').'" width="" loading="lazy">';

																	echo '</div>';
																} 

														endforeach;

													} else {

														echo '<p class="info-box__subbox-header is-gallery-empty__status-text-holder">Aktualnie nie masz dodanych żadnych zdjęć.</p>';
														
													};

													echo '</div>';

													echo gallery_image_uploader($user_post_id);


												echo '</div>';

											echo '</div>';

										echo '</div>';

									echo '</div>';

								echo '</div>';

								/* VIDEOS CONTAINER */

								echo '<div class="info-box pictures-container">';

									echo '<div class="account__box-container">';

										echo '<div class="info-box__header"><p>Filmy</p></div>';
									
									/* AJAX LOADER */

									echo '<div class="my-ajax-loader">
											<div class="my-ajax-loader__spinner"></div>
											<div class="progress">
												<div class="progress-bar"></div>
												<div class="progress-percents"></div>
											</div>
										</div>';

									/* CONTENT BOX */

									echo '<div class="content-box">';

										echo '<div class="info-box__subbox wrapper-flex-drow-mcol w--full">';

											/* VIDEO GALLERY PANEL */

											echo '<div class="my-videos__wrapper ajax-content-wrapper col-m100-d50">';

												echo '<div class="my-videos__gallery">';

													/* DYNAMIC MESSAGES CONTENT HOLDER */

													echo '<div class="is-gallery-empty__messages" style="display: none">';
													echo '<p class="is-gallery-empty__yes">Aktualnie nie masz dodanych żadnych filmów.</p>';
													echo '<p class="is-gallery-empty__no">Filmy:</p>';
													echo '</div>';

												// var_dump($videos_to_gallery_array);

												if ($videos_to_gallery_array) {

													echo '<p class="info-box__subbox-header is-gallery-empty__status-text-holder">Filmy</p>';

													//start at 1 because acf repeater rows indexes start with 1

													$i = 1;

													foreach ($videos_to_gallery_array as $video) :

															$video_link = $video['translator_single_video'];

															if($video_link) {

																$video_id = attachment_url_to_postid($video_link);

																echo '<div class="my-videos__gallery-attachment">';

																	echo '<a class="remove-item" href="#" data-id="'.$i.'"></a>';

																	echo '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
																	viewBox="0 0 298 298" style="enable-background:new 0 0 298 298;" xml:space="preserve">
																	<path d="M298,33c0-13.255-10.745-24-24-24H24C10.745,9,0,19.745,0,33v232c0,13.255,10.745,24,24,24h250c13.255,0,24-10.745,24-24V33
																z M91,39h43v34H91V39z M61,259H30v-34h31V259z M61,73H30V39h31V73z M134,259H91v-34h43V259z M123,176.708v-55.417
																c0-8.25,5.868-11.302,12.77-6.783l40.237,26.272c6.902,4.519,6.958,11.914,0.056,16.434l-40.321,26.277
																C128.84,188.011,123,184.958,123,176.708z M207,259h-43v-34h43V259z M207,73h-43V39h43V73z M268,259h-31v-34h31V259z M268,73h-31V39
																h31V73z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';

																	$video_name = basename(get_attached_file( $video_id ));

																	echo '<p>'.$video_name.'</p>';

																echo '</div>';
															} 

															$i++;

													endforeach;

												} else {

													echo '<p class="info-box__subbox-header is-gallery-empty__status-text-holder">Aktualnie nie masz dodanych żadnych filmów.</p>';
													
												};

												echo '</div>';

												echo '<div id="newVideoInGalleryPlaceholder" class="my-videos__gallery-attachment" style="display:none;" >';

													echo '<a class="remove-item remove" data-id="clear-input" href="#"></a>';

													echo '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
													viewBox="0 0 298 298" style="enable-background:new 0 0 298 298;" xml:space="preserve">
													<path d="M298,33c0-13.255-10.745-24-24-24H24C10.745,9,0,19.745,0,33v232c0,13.255,10.745,24,24,24h250c13.255,0,24-10.745,24-24V33
														z M91,39h43v34H91V39z M61,259H30v-34h31V259z M61,73H30V39h31V73z M134,259H91v-34h43V259z M123,176.708v-55.417
														c0-8.25,5.868-11.302,12.77-6.783l40.237,26.272c6.902,4.519,6.958,11.914,0.056,16.434l-40.321,26.277
														C128.84,188.011,123,184.958,123,176.708z M207,259h-43v-34h43V259z M207,73h-43V39h43V73z M268,259h-31v-34h31V259z M268,73h-31V39
														h31V73z"/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';

													echo '<p></p>';

												echo '</div>';

												echo gallery_video_uploader($user_post_id);

											echo '</div>';

										echo '</div>';

									echo '</div>';

								echo '</div>';

							echo '</div>';