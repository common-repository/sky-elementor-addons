<?php
$sky_addons_admin = Sky_Addons\Admin\Sky_Addons_Admin();
$sky_elements = $sky_addons_admin::get_element_list();
$sky_db_init = $sky_addons_admin::option_init_check( [ 'sky_addons_inactive_widgets', 'sky_addons_inactive_3rd_party_widgets', 'sky_addons_inactive_extensions' ] );

$sky_pro_init = apply_filters( 'sky_addons_pro_init', false );

$ribbon_text = '';


?>
<div class="wrap">
	<div class="sky-wrap">
		<div class="sa-dashboard-tab-container sa-py-5 sa-px-4">
			<div class="sa-left-side sa-sidebar-nav">
				<ul class="nav sa-nav-tabs metismenu sa-d-flex" id="sa-metismenu">

					<li class="mm-active">
						<a data-tab="tab-dashboard">
							<div class="sa-menu-wrap sa-d-flex sa-align-items-center sa-py-2">
								<div class="sa-icon-area sa-d-flex sa-align-items-center sa-me-3">
									<div class="sa-icon-wrap">
										<svg viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd"
												d="M9.5 4.5a1 1 0 00-1-1h-4a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1v-4zm-1 7h-4v4h4v-4zm7 0h-4v4h4v-4zm0-7h-4v4h4v-4zm-7 0h-4v4h4v-4zm2 0a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4zm-6 6a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1v-4a1 1 0 00-1-1h-4zm7 0a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1v-4a1 1 0 00-1-1h-4z"
												clip-rule="evenodd" />
										</svg>
									</div>
								</div>
								<div class="sa-menu-content">
									<h4 class="sa-menu-title sa-m-0 sa-fw-bold">
										<?php esc_html_e( 'Dashboard', 'sky-elementor-addons' ); ?>
									</h4>
									<div class="sa-menu-desc">Information in view</div>
								</div>
							</div>
						</a>
					</li>
					<li>
						<a data-tab="tab-widgets">
							<div class="sa-menu-wrap sa-d-flex sa-align-items-center sa-py-2">
								<div class="sa-icon-area sa-d-flex sa-align-items-center sa-me-3">
									<div class="sa-icon-wrap">
										<svg viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd"
												d="M4 5.5A1.5 1.5 0 005.5 7H7V5.5a1.5 1.5 0 10-3 0zM8 8V5.5A2.5 2.5 0 105.5 8H8zm8-2.5A1.5 1.5 0 0114.5 7H13V5.5a1.5 1.5 0 013 0zM12 8V5.5A2.5 2.5 0 1114.5 8H12zm-8 6.5A1.5 1.5 0 015.5 13H7v1.5a1.5 1.5 0 01-3 0zM8 12v2.5A2.5 2.5 0 115.5 12H8zm8 2.5a1.5 1.5 0 00-1.5-1.5H13v1.5a1.5 1.5 0 003 0zM12 12v2.5a2.5 2.5 0 102.5-2.5H12z"
												clip-rule="evenodd" />
											<path fill-rule="evenodd" d="M12 8H8v4h4V8zM7 7v6h6V7H7z" clip-rule="evenodd" />
										</svg>
									</div>
								</div>
								<div class="sa-menu-content">
									<h4 class="sa-menu-title sa-m-0 sa-fw-bold">
										<?php esc_html_e( 'Widgets', 'sky-elementor-addons' ); ?>
									</h4>
									<div class="sa-menu-desc">Manage Widgets</div>
								</div>
							</div>
						</a>
					</li>
					<li>
						<a data-tab="tab-3rd-party">
							<div class="sa-menu-wrap sa-d-flex sa-align-items-center sa-py-2">
								<div class="sa-icon-area sa-d-flex sa-align-items-center sa-me-3">
									<div class="sa-icon-wrap">
										<svg viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd"
												d="M5 4h8a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2zm0 1a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1V6a1 1 0 00-1-1H5z"
												clip-rule="evenodd" />
											<path
												d="M7 2h8a2 2 0 012 2v10a2 2 0 01-2 2v-1a1 1 0 001-1V4a1 1 0 00-1-1H7a1 1 0 00-1 1H5a2 2 0 012-2z" />
										</svg>
									</div>
								</div>
								<div class="sa-menu-content">
									<h4 class="sa-menu-title sa-m-0 sa-fw-bold">
										<?php esc_html_e( '3rd Party', 'sky-elementor-addons' ); ?>
									</h4>
									<div class="sa-menu-desc">Manage 3rd Party</div>
								</div>
							</div>
						</a>
					</li>
					<li>
						<a data-tab="tab-extensions">
							<div class="sa-menu-wrap sa-d-flex sa-align-items-center sa-py-2">
								<div class="sa-icon-area sa-d-flex sa-align-items-center sa-me-3">
									<div class="sa-icon-wrap">
										<svg viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd"
												d="M5 4h8a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2zm0 1a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1V6a1 1 0 00-1-1H5z"
												clip-rule="evenodd" />
											<path
												d="M7 2h8a2 2 0 012 2v10a2 2 0 01-2 2v-1a1 1 0 001-1V4a1 1 0 00-1-1H7a1 1 0 00-1 1H5a2 2 0 012-2z" />
										</svg>
									</div>
								</div>
								<div class="sa-menu-content">
									<h4 class="sa-menu-title sa-m-0 sa-fw-bold">
										<?php esc_html_e( 'Extensions', 'sky-elementor-addons' ); ?>
									</h4>
									<div class="sa-menu-desc">Manage Features</div>
								</div>
							</div>
						</a>
					</li>

					<li>
						<a data-tab="tab-api">
							<div class="sa-menu-wrap sa-d-flex sa-align-items-center sa-py-2">
								<div class="sa-icon-area sa-d-flex sa-align-items-center sa-me-3">
									<div class="sa-icon-wrap">
										<svg viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd"
												d="M13.655 9H6.333c-.264 0-.398.068-.471.121a.73.73 0 00-.224.296 1.626 1.626 0 00-.138.59V15c0 .342.076.531.14.635.064.106.151.18.256.237a1.122 1.122 0 00.436.127l.013.001h7.322c.264 0 .398-.068.471-.121a.73.73 0 00.224-.296 1.627 1.627 0 00.138-.59V10c0-.342-.076-.531-.14-.635a.658.658 0 00-.255-.237 1.123 1.123 0 00-.45-.128zm.012-1H6.333C4.5 8 4.5 10 4.5 10v5c0 2 1.833 2 1.833 2h7.334c1.833 0 1.833-2 1.833-2v-5c0-2-1.833-2-1.833-2zM6.5 5a3.5 3.5 0 117 0v3h-1V5a2.5 2.5 0 00-5 0v3h-1V5z"
												clip-rule="evenodd" />
										</svg>
									</div>
								</div>
								<div class="sa-menu-content">
									<h4 class="sa-menu-title sa-m-0 sa-fw-bold">
										<?php esc_html_e( 'API Data', 'sky-elementor-addons' ); ?>
									</h4>
									<div class="sa-menu-desc">Manage Credentials</div>
								</div>
							</div>
						</a>
					</li>

					<li>
						<a data-tab="tab-analytics-used-widgets" class="has-arrow" aria-expanded="false" href="javascript:void(0);">
							<div class="sa-menu-wrap sa-d-flex sa-align-items-center sa-py-2">
								<div class="sa-icon-area sa-d-flex sa-align-items-center sa-me-3">
									<div class="sa-icon-wrap">
										<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rocket" width="44"
											height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
											stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<path
												d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" />
											<path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" />
											<circle cx="15" cy="9" r="1" />
										</svg>
									</div>
								</div>
								<div class="sa-menu-content">
									<h4 class="sa-menu-title sa-m-0 sa-fw-bold">
										<?php esc_html_e( 'Analytics', 'sky-elementor-addons' ); ?>
									</h4>
									<div class="sa-menu-desc">
										Boost Efficiency
									</div>
								</div>
							</div>
						</a>
						<ul>
							<li>
								<a href="#" data-tab="tab-analytics-used-widgets"
									class="sa-menu-wrap sa-sub-menu-wrap sa-align-items-center">
									<div class="sa-icon-wrap  sa-mx-3">
										<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="44"
											height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
											stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<rect x="4" y="4" width="6" height="6" rx="1" />
											<rect x="4" y="14" width="6" height="6" rx="1" />
											<rect x="14" y="14" width="6" height="6" rx="1" />
											<line x1="14" y1="7" x2="20" y2="7" />
											<line x1="17" y1="4" x2="17" y2="10" />
										</svg>
									</div>
									<h4 class="sa-menu-title sa-m-0 sa-fw-bold">Used Widgets</h4>
								</a>
							</li>
							<li>
								<a href="#" data-tab="tab-analytics-unused-widgets"
									class="sa-menu-wrap sa-sub-menu-wrap sa-align-items-center">
									<div class="sa-icon-wrap  sa-mx-3">
										<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="44"
											height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
											stroke-linecap="round" stroke-linejoin="round">
											<path stroke="none" d="M0 0h24v24H0z" fill="none" />
											<rect x="4" y="4" width="6" height="6" rx="1" />
											<rect x="4" y="14" width="6" height="6" rx="1" />
											<rect x="14" y="14" width="6" height="6" rx="1" />
											<line x1="14" y1="7" x2="20" y2="7" />
											<line x1="17" y1="4" x2="17" y2="10" />
										</svg>
									</div>
									<h4 class="sa-menu-title sa-m-0 sa-fw-bold">Unused Widgets</h4>
								</a>
							</li>
						</ul>
					</li>

					<?php if ( $sky_pro_init !== true ) : ?>
						<li>
							<a data-tab="tab-pro">
								<div class="sa-menu-wrap sa-d-flex sa-align-items-center sa-py-2">
									<div class="sa-icon-area sa-d-flex sa-align-items-center sa-me-3">
										<div class="sa-icon-wrap">
											<svg viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd"
													d="M5.1 2.7a.5.5 0 01.4-.2h9a.5.5 0 01.4.2l2.976 3.974c.149.185.156.45.01.644L10.4 17.3a.5.5 0 01-.8 0l-7.5-10a.5.5 0 010-.6l3-4zm11.386 3.785l-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004l.961-2.989H6.186l.963 2.995 5.704-.006zM7.47 7.495l5.062-.005L10 15.366 7.47 7.495zm-1.371-.999l-.78-2.422-1.818 2.425 2.598-.003zM3.499 7.5l2.92-.003 2.193 6.82L3.5 7.5zm7.889 6.817l2.194-6.828 2.929-.003-5.123 6.831z"
													clip-rule="evenodd" />
											</svg>
										</div>
									</div>
									<div class="sa-menu-content">
										<h4 class="sa-menu-title sa-m-0 sa-fw-bold">
											<?php esc_html_e( 'Get Pro', 'sky-elementor-addons' ); ?>
										</h4>
										<div class="sa-menu-desc">Unlock premium features</div>
									</div>
								</div>
							</a>
						</li>
					<?php else : ?>
						<?php if ( ! defined( 'SKY_ADDONS_L_H' ) ) : ?>
							<li>
								<a class="sa-tab-license" data-tab="tab-license"
									href="<?php echo esc_url( admin_url( 'admin.php?page=sky-elementor-addons-license' ) ); ?>">
									<div class="sa-menu-wrap sa-d-flex sa-align-items-center sa-py-2">
										<div class="sa-icon-area sa-d-flex sa-align-items-center sa-me-3">
											<div class="sa-icon-wrap">
												<svg viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd"
														d="M7.443 3.991a60.17 60.17 0 00-2.725.802.454.454 0 00-.315.366C3.87 9.056 5.1 11.9 6.567 13.773c.736.94 1.533 1.636 2.197 2.093.333.228.626.394.857.5.116.053.21.089.282.11A.73.73 0 0010 16.5a.774.774 0 00.097-.023c.072-.022.166-.058.282-.111a5.94 5.94 0 00.857-.5 10.198 10.198 0 002.197-2.093C14.9 11.9 16.13 9.056 15.597 5.159a.454.454 0 00-.315-.366c-.626-.2-1.682-.526-2.725-.802C11.491 3.71 10.51 3.5 10 3.5c-.51 0-1.49.21-2.557.491zm-.256-.966C8.23 2.749 9.337 2.5 10 2.5c.662 0 1.77.249 2.813.525 1.066.282 2.14.614 2.772.815.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.192 11.192 0 01-2.418 2.3 6.942 6.942 0 01-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 01-1.007-.586 11.192 11.192 0 01-2.418-2.3c-1.611-2.058-2.94-5.168-2.367-9.365A1.454 1.454 0 014.415 3.84a61.105 61.105 0 012.772-.815z"
														clip-rule="evenodd" />
													<path
														d="M10 4.25c.909 0 3.188.685 4.254 1.022a.94.94 0 01.656.773c.814 6.424-4.13 9.452-4.91 9.452V4.25z" />
												</svg>
											</div>
										</div>

										<div class="sa-menu-content">
											<h4 class="sa-menu-title sa-m-0 sa-fw-bold">
												<?php esc_html_e( 'License', 'sky-elementor-addons' ); ?>
											</h4>
											<div class="sa-menu-desc">License Information</div>
										</div>
									</div>

								</a>
							</li>
						<?php endif; ?>
					<?php endif; ?>


					<!-- <li> <a data-tab="tab-about">About</a> </li> -->
					<!-- <li>
						<a id="ID1" href="#" class="has-arrow" aria-expanded="false" data-tab="tab-test">Val1</a>
						<ul>
							<li><a href="#">Val2</a></li>
							<li><a href="#">Val2</a></li>
						</ul>
					</li> -->
					<!-- <li><a href="#another">Another Link</a></li> -->
				</ul>
			</div>
			<div class="sa-right-side">
				<div class="tab-content">
					<div id="tab-dashboard" class="tab-pane active">
						<div class="sa-container-grid-dashboard">
							<div class="sa-dashboard-welcome sa-welcome-section sa-d-flex sa-align-items-center sa-p-4">
								<div class="sa-welcome-overlay"
									style="background-image: url('<?php echo esc_url( SKY_ADDONS_ASSETS_URL ) . 'images/dashboard-rocket-hero-section.jpg'; ?>');">
								</div>
								<div class="sa-content sa-d-flex sa-align-items-center sa-py-4">
									<div>
										<h4 class="sa-title sa-mb-3 sa-mt-0">
											<?php esc_html_e( 'Sky Addons for Elementor', 'sky-elementor-addons' ); ?>
										</h4>
										<p>
											<?php esc_html_e( 'Power to create stunning websites with one-click. Create beautiful, <br>mobile-ready sites in minutes.', 'sky-elementor-addons' ); ?>
										</p>
										<p class="sa-fw-bold sa-mb-0">
											<?php
											esc_html_e( 'Version -', 'sky-elementor-addons' );
											echo esc_html( SKY_ADDONS_VERSION );
											esc_html_e( ' (free/core)', 'sky-elementor-addons' );

											$sky_pro_version = '';
											$sky_pro_version = apply_filters( 'sky_addons_pro_version', $sky_pro_version );
											echo esc_html( ! empty( $sky_pro_version ) ? $sky_pro_version : '' );
											?>
										</p>
									</div>
								</div>
							</div>
							<div class="sa-dashboard-info sa-mt-4">
								<div class="sa-info-item sa-p-4">
									<div class="sa-info-icon">
										<svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 0 24 24" width="48px">
											<path d="M0 0h24v24H0z" fill="none" />
											<path
												d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
										</svg>
									</div>
									<h4 class="sa-info-title sa-mb-4">
										<?php esc_html_e( 'Documentation', 'sky-elementor-addons' ); ?>
									</h4>
									<div class="sa-info-text sa-mb-4">
										<?php esc_html_e( 'It\'s hard to create good documentation. It\'s even harder to make it awesome. But we think we\'ve solved this for you. We\'ve created a complete package, with everything you need to make your documentation as awesome as the product you\'re building.', 'sky-elementor-addons' ) ?>
									</div>
									<a class="sa-info-btn sa-anim-btn-1" href="https://skyaddons.com/blog/">
										<?php esc_html_e( 'Check now', 'sky-elementor-addons' ); ?>
									</a>
								</div>

								<div class="sa-info-item sa-p-4">
									<div class="sa-info-icon">
										<svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 0 24 24" width="48px">
											<path d="M0 0h24v24H0z" fill="none" />
											<path
												d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
										</svg>
									</div>
									<h4 class="sa-info-title sa-mb-4">
										<?php esc_html_e( 'Widgets Demo', 'sky-elementor-addons' ); ?>
									</h4>
									<div class="sa-info-text sa-mb-4">
										<?php esc_html_e( 'We are making an easy way to create your own website. With Widget Demo, you can launch your website in just a few minutes. You can create unlimited free demo site with more than 1000+ design layouts. All designs are fully responsive and ready-to-use.', 'sky-elementor-addons' ); ?>
									</div>
									<a class="sa-info-btn sa-anim-btn-1" href="https://demo.skyaddons.com/">
										<?php esc_html_e( 'Live Demo', 'sky-elementor-addons' ); ?>
									</a>
								</div>

								<div class="sa-info-item sa-p-4">
									<div class="sa-info-icon">
										<svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 0 24 24" width="48px">
											<path d="M0 0h24v24H0z" fill="none" opacity=".1" />
											<path
												d="M12 1c-4.97 0-9 4.03-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-4v8h4v1h-7v2h6c1.66 0 3-1.34 3-3V10c0-4.97-4.03-9-9-9z" />
										</svg>
									</div>
									<h4 class="sa-info-title sa-mb-4">
										<?php esc_html_e( 'Need Help?', 'sky-elementor-addons' ); ?>
									</h4>
									<div class="sa-info-text sa-mb-4">
										<?php esc_html_e( 'Customer satisfaction is our top priority. We take pride in the support we provide our users. Whether you need help with our app or want to provide feedback or ask a question, please don\'t hesitate to contact us right away.', 'sky-elementor-addons' ); ?>
									</div>
									<a class="sa-info-btn sa-anim-btn-1" href="https://skyaddons.com/support/">
										<?php esc_html_e( 'Support Ticket', 'sky-elementor-addons' ); ?>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div id="tab-widgets" class="tab-pane">
						<form class="sky-option-form" id="sky_opt_widget" method="post"
							action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
							<input type="hidden" name="sky_input_options[option_page]" value="sky_addons_inactive_widgets">
							<input type="hidden" name="action" value="sky_save_option_data">
							<?php wp_nonce_field( "skyoption" ); ?>
							<div class="sa-section-action sa-mb-3 sa-mb-3">

								<?php apply_filters( 'sky_allow_tracker_notice', false ); ?>

								<div class="sa-d-flex sa-align-items-center sa-pe-2 sa-mb-2">
									<p>
										<?php esc_html_e( 'Let’s make your streaming experience hassle-free. You can control every feature of Sky Addons by activating or deactivating from here.', 'sky-elementor-addons' ); ?>
									</p>
								</div>
								<div class="sa-btn-group sa-d-flex sa-anim-btn-1">
									<button class="sa-rounded sa-active-all-btn" type="button">
										<?php esc_html_e( 'Enable All', 'sky-elementor-addons' ); ?>
									</button>
									<button class="sa-rounded sa-deactivate-all-btn" type="button">
										<?php esc_html_e( 'Disable All', 'sky-elementor-addons' ); ?>
									</button>
								</div>
							</div>
							<!-- container -->
							<div class="sa-container-grid-widget sa-py-3">
								<?php

								foreach ( $sky_elements['sky_addons_widgets'] as $key => $element ) {
									$element['value'] = $sky_db_init['sky_addons_inactive_widgets'] !== true ? $element['default'] : $element['value'];

									$pro_check = $element['widget_type'] == 'pro' && $sky_pro_init !== true ? 'disabled' : '';

									$checked = ( 'on' == $element['value'] ) ? ' checked ' : '';

									$checked = ( $sky_pro_init !== true && $element['widget_type'] == 'pro' ) ? '' : $checked;

									$widget_class = $element['widget_type'] == 'pro' && $sky_pro_init !== true ? 'pro pro-widget' : $element['widget_type'];


									/**
									 * Ribbon Condition
									 */

									if ( $element['widget_type'] == 'pro' && $sky_pro_init !== true ) {
										$widget_class .= ' sa-ribbon';
										$ribbon_text = esc_html__( 'Pro', 'sky-elementor-addons' );
									}

									if ( str_contains( $element['content_type'], 'new' ) && ( $element['widget_type'] != 'pro' || $sky_pro_init == true ) ) {
										$widget_class .= ' sa-ribbon';
										$ribbon_text = esc_html__( 'New', 'sky-elementor-addons' );
									}

									/**
									 * Analytics Setup
									 * Count used widgets
									 * @since 1.0.6
									 */
									$used_widgets = $sky_addons_admin->get_used_widgets_obj();
									$widget_name = 'sky-' . $element['name'];
									$used_widgets_count = 0;

									if ( isset( $used_widgets ) ) {
										$used_widgets_count = ( in_array( $widget_name, array_keys( $used_widgets ) ) ? $used_widgets[ $widget_name ] : 0 );
									}

									?>
									<div
										class="sa-grid-col sa-grid-item sa_widget_item sa-d-flex sa-align-items-center sa-justify-content-between sa-p-4 <?php echo esc_attr( $widget_class ); ?> sa-ribbon-left"
										data-ribbon="<?php echo esc_html( $ribbon_text ); ?>">
										<div class="sa-icon-wrap sa-me-2">
											<i class="sky-icon-<?php echo esc_attr( $element['name'] ); ?>"></i>
										</div>
										<div class="sa-w-100">
											<div class="sa-item-text sa-d-flex sa-align-items-center">
												<?php echo esc_attr( $element['label'] ); ?>
												<a class="sa-demo-link-icon sa-d-inline-block sa-mx-2 sa-text-decoration-none" target="_blank"
													title="<?php esc_html_e( 'See Demo', 'sky-elementor-addons' ); ?>"
													href="<?php echo esc_url( $element['demo_url'] ); ?>">
													<i class="dashicons dashicons-desktop"></i>
												</a>
											</div>
											<small title="Total Used">
												Used -
												<?php echo esc_html( sprintf( "%02d", $used_widgets_count ) ); ?>
											</small>
										</div>
										<div class="sa-d-flex sa-mx-2 sa-align-items-center sa-d-none">
											<div class="sa-fw-bold sa-text-secondary sa-mb-2">(10)</div>
											<a class="sa-demo-link-icon sa-d-inline-block sa-mx-2 sa-text-decoration-none" target="_blank"
												title="<?php esc_html_e( 'See Demo', 'sky-elementor-addons' ); ?>"
												href="<?php echo esc_url( $element['demo_url'] ); ?>">
												<i class="dashicons dashicons-desktop"></i>
											</a>
										</div>
										<div class="sa-item-switcher sa-ms-2">
											<div class="sa-toggle">
												<?php
												printf(
													'<input type="hidden" value="off" name="sky_input_options[%s]" %s>',
													esc_attr( $element['name'] ),
													esc_attr( $pro_check )
												);

												printf(
													'<input type="checkbox" id="sky_input_options[%s]" name="sky_input_options[%s]" value="on" class="sa-checkbox" %s %s>',
													esc_attr( $element['name'] ),
													esc_attr( $element['name'] ),
													esc_attr( $checked ),
													esc_attr( $pro_check )
												);

												?>

												<label for="sky_input_options[<?php echo esc_attr( $element['name'] ); ?>]">
													<div></div>
												</label>
											</div>
										</div>
									</div>
									<?php
								}
								?>

							</div>
							<!-- /container -->
							<p class="sa-option-submit sa-anim-btn-1 sa-py-3">
								<button type="submit" class="button button-primary">
									<?php esc_html_e( 'Save Settings', 'sky-elementor-addons' ); ?>
								</button>
							</p>
						</form>
					</div>
					<div id="tab-3rd-party" class="tab-pane">
						<form class="sky-option-form" id="sky_opt_3rd_party_widget" method="post"
							action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
							<input type="hidden" name="sky_input_options[option_page]" value="sky_addons_inactive_3rd_party_widgets">
							<input type="hidden" name="action" value="sky_save_option_data">
							<?php wp_nonce_field( "skyoption" ); ?>
							<div class="sa-section-action sa-mb-3 sa-mb-3">

								<?php apply_filters( 'sky_allow_tracker_notice', false ); ?>

								<div class="sa-d-flex sa-align-items-center sa-pe-2 sa-mb-2">
									<p>
										<?php esc_html_e( 'Let’s make your streaming experience hassle-free. You can control every feature of Sky Addons by activating or deactivating from here.', 'sky-elementor-addons' ); ?>
									</p>
								</div>
								<div class="sa-btn-group sa-d-flex sa-anim-btn-1">
									<button class="sa-rounded sa-active-all-btn" type="button">
										<?php esc_html_e( 'Enable All', 'sky-elementor-addons' ); ?>
									</button>
									<button class="sa-rounded sa-deactivate-all-btn" type="button">
										<?php esc_html_e( 'Disable All', 'sky-elementor-addons' ); ?>
									</button>
								</div>
							</div>
							<!-- container -->
							<div class="sa-container-grid-widget sa-py-3">
								<?php

								foreach ( $sky_elements['sky_addons_3rd_party_widget'] as $key => $element ) {
									$element['value'] = $sky_db_init['sky_addons_inactive_3rd_party_widgets'] !== true ? $element['default'] : $element['value'];

									$pro_check = $element['widget_type'] == 'pro' && $sky_pro_init !== true ? 'disabled' : '';

									$checked = ( 'on' == $element['value'] ) ? ' checked ' : '';

									$checked = ( $sky_pro_init !== true && $element['widget_type'] == 'pro' ) ? '' : $checked;

									$widget_class = $element['widget_type'] == 'pro' && $sky_pro_init !== true ? 'pro pro-widget' : $element['widget_type'];


									/**
									 * Ribbon Condition
									 */

									if ( $element['widget_type'] == 'pro' && $sky_pro_init !== true ) {
										$widget_class .= ' sa-ribbon';
										$ribbon_text = esc_html__( 'Pro', 'sky-elementor-addons' );
									}

									if ( str_contains( $element['content_type'], 'new' ) && ( $element['widget_type'] != 'pro' || $sky_pro_init == true ) ) {
										$widget_class .= ' sa-ribbon';
										$ribbon_text = esc_html__( 'New', 'sky-elementor-addons' );
									}

									/**
									 * Analytics Setup
									 * Count used widgets
									 * @since 1.0.6
									 */
									$used_widgets = $sky_addons_admin->get_used_widgets_obj();
									$widget_name = 'sky-' . $element['name'];
									$used_widgets_count = 0;

									if ( isset( $used_widgets ) ) {
										$used_widgets_count = ( in_array( $widget_name, array_keys( $used_widgets ) ) ? $used_widgets[ $widget_name ] : 0 );
									}

									?>
									<div
										class="sa-grid-col sa-grid-item sa_widget_item sa-d-flex sa-align-items-center sa-justify-content-between sa-p-4 <?php echo esc_attr( $widget_class ); ?> sa-ribbon-left"
										data-ribbon="<?php echo esc_html( $ribbon_text ); ?>">
										<div class="sa-icon-wrap sa-me-2">
											<i class="sky-icon-<?php echo esc_attr( $element['name'] ); ?>"></i>
										</div>
										<div class="sa-w-100">
											<div class="sa-item-text sa-d-flex sa-align-items-center">
												<?php echo esc_attr( $element['label'] ); ?>
												<a class="sa-demo-link-icon sa-d-inline-block sa-mx-2 sa-text-decoration-none" target="_blank"
													title="<?php esc_html_e( 'See Demo', 'sky-elementor-addons' ); ?>"
													href="<?php echo esc_url( $element['demo_url'] ); ?>">
													<i class="dashicons dashicons-desktop"></i>
												</a>
											</div>
											<small title="Total Used">
												Used -
												<?php echo esc_html( sprintf( "%02d", $used_widgets_count ) ); ?>
											</small>
										</div>
										<div class="sa-d-flex sa-mx-2 sa-align-items-center sa-d-none">
											<div class="sa-fw-bold sa-text-secondary sa-mb-2">(10)</div>
											<a class="sa-demo-link-icon sa-d-inline-block sa-mx-2 sa-text-decoration-none" target="_blank"
												title="<?php esc_html_e( 'See Demo', 'sky-elementor-addons' ); ?>"
												href="<?php echo esc_url( $element['demo_url'] ); ?>">
												<i class="dashicons dashicons-desktop"></i>
											</a>
										</div>
										<div class="sa-item-switcher sa-ms-2">
											<div class="sa-toggle">
												<?php
												printf(
													'<input type="hidden" value="off" name="sky_input_options[%s]" %s>',
													esc_attr( $element['name'] ),
													esc_attr( $pro_check )
												);

												printf(
													'<input type="checkbox" id="sky_input_options[%s]" name="sky_input_options[%s]" value="on" class="sa-checkbox" %s %s>',
													esc_attr( $element['name'] ),
													esc_attr( $element['name'] ),
													esc_attr( $checked ),
													esc_attr( $pro_check )
												);

												?>

												<label for="sky_input_options[<?php echo esc_attr( $element['name'] ); ?>]">
													<div></div>
												</label>
											</div>
										</div>
									</div>
									<?php
								}
								?>

							</div>
							<!-- /container -->
							<p class="sa-option-submit sa-anim-btn-1 sa-py-3">
								<button type="submit" class="button button-primary">
									<?php esc_html_e( 'Save Settings', 'sky-elementor-addons' ); ?>
								</button>
							</p>
						</form>
					</div>
					<div id="tab-extensions" class="tab-pane">
						<form class="sky-option-form" id="sky_opt_extensions" method="post"
							action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
							<input type="hidden" name="sky_input_options[option_page]" value="sky_addons_inactive_extensions">
							<input type="hidden" name="action" value="sky_save_option_data">
							<?php wp_nonce_field( "skyoption" ); ?>

							<div class="sa-section-action sa-mb-3">
								<div class="sa-d-flex sa-align-items-center sa-pe-2 sa-mb-2">
									<p>
										<?php esc_html_e( 'Let’s make your streaming experience hassle-free. You can control every feature of Sky Addons by activating or deactivating from here.', 'sky-elementor-addons' ); ?>
									</p>
								</div>
								<div class="sa-btn-group sa-d-flex sa-anim-btn-1 ">
									<button class="sa-rounded sa-active-all-btn" type="button">
										<?php esc_html_e( 'Enable All', 'sky-elementor-addons' ); ?>
									</button>
									<button class="sa-rounded sa-deactivate-all-btn" type="button">
										<?php esc_html_e( 'Disable All', 'sky-elementor-addons' ); ?>
									</button>
								</div>
							</div>

							<!-- container -->
							<div class="sa-container-grid-widget sa-py-3">
								<?php
								foreach ( $sky_elements['sky_addons_extensions'] as $key => $element ) {
									$element['value'] = $sky_db_init['sky_addons_inactive_extensions'] !== true ? $element['default'] : $element['value'];

									$pro_check = $element['widget_type'] == 'pro' && $sky_pro_init !== true ? 'disabled' : '';

									$checked = ( 'on' == $element['value'] ) ? ' checked ' : '';

									$checked = ( $sky_pro_init !== true && $element['widget_type'] == 'pro' ) ? '' : $checked;

									$widget_class = $element['widget_type'] == 'pro' && $sky_pro_init !== true ? 'pro pro-widget' : $element['widget_type'];

									/**
									 * Ribbon Condition
									 */

									if ( $element['widget_type'] == 'pro' && $sky_pro_init !== true ) {
										$widget_class .= ' sa-ribbon';
										$ribbon_text = esc_html__( 'Pro', 'sky-elementor-addons' );
									}

									if ( str_contains( $element['content_type'], 'new' ) && ( $element['widget_type'] != 'pro' || $sky_pro_init == true ) ) {
										$widget_class .= ' sa-ribbon';
										$ribbon_text = esc_html__( 'New', 'sky-elementor-addons' );
									}

									?>
									<div
										class="sa-grid-col sa-grid-item sa_widget_item sa-d-flex sa-align-items-center sa-justify-content-between sa-p-4 <?php echo esc_attr( $widget_class ); ?> sa-ribbon-left"
										data-ribbon="<?php echo esc_html( $ribbon_text ); ?>">
										<div class="sa-icon-wrap sa-me-2">
											<i class="sky-icon-<?php echo esc_attr( $element['name'] ); ?>"></i>
										</div>
										<div class="sa-w-100">
											<div class="sa-item-text sa-d-flex sa-align-items-center">
												<?php echo esc_attr( $element['label'] ); ?>
												<a class="sa-demo-link-icon sa-d-inline-block sa-mx-2 sa-text-decoration-none" target="_blank"
													title="<?php esc_html_e( 'See Demo', 'sky-elementor-addons' ); ?>"
													href="<?php echo esc_url( $element['demo_url'] ); ?>">
													<i class="dashicons dashicons-desktop"></i>
												</a>
											</div>
										</div>
										<div class="sa-item-switcher sa-ms-2">
											<div class="sa-toggle">
												<?php
												printf(
													'<input type="hidden" value="off" name="sky_input_options[%s]" %s>',
													esc_attr( $element['name'] ),
													esc_attr( $pro_check )
												);

												printf(
													'<input type="checkbox" id="sky_input_options[%s]" name="sky_input_options[%s]" value="on" class="sa-checkbox" %s %s>',
													esc_attr( $element['name'] ),
													esc_attr( $element['name'] ),
													esc_attr( $checked ),
													esc_attr( $pro_check )
												);

												?>

												<label for="sky_input_options[<?php echo esc_attr( $element['name'] ); ?>]">
													<div></div>
												</label>
											</div>
										</div>
									</div>
									<?php
								}
								?>

							</div>
							<!-- /container -->
							<p class="sa-option-submit sa-anim-btn-1 sa-py-3">
								<button type="submit" class="button button-primary">
									<?php esc_html_e( 'Save Settings', 'sky-elementor-addons' ); ?>
								</button>
							</p>
						</form>
					</div>
					<div id="tab-api" class="tab-pane">
						<form class="sky-option-form" id="sky_opt_api" method="post"
							action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
							<input type="hidden" name="sky_input_options[option_page]" value="sky_addons_api">
							<input type="hidden" name="action" value="sky_save_option_data">
							<?php wp_nonce_field( "skyoption" ); ?>
							<p class="sa-py-3 sa-mb-3">
								<?php esc_html_e( 'Sometimes you want to use advanced features of API-related functionality. In this case, sometimes we need an API key to access your data. You can store your API keys here. If you are not using below widgets then you can skip the section.', 'sky-elementor-addons' ); ?>
							</p>
							<!-- container -->
							<div class="sa-container-grid-api sa-py-3">
								<?php
								foreach ( $sky_elements['sky_addons_api'] as $input_key => $element_group ) {
									$pro_check = $element_group['widget_type'] == 'pro' && $sky_pro_init !== true ? 'disabled' : '';
									$widget_class = $element_group['widget_type'] == 'pro' && $sky_pro_init !== true ? 'pro pro-widget' : $element_group['widget_type'];

									?>
									<div
										class="sa-grid-col sa-grid-item sa-p-4  <?php echo esc_attr( $widget_class ); ?>	 sa-ribbon sa-ribbon-left"
										data-ribbon="<?php echo esc_html__( 'Pro', 'sky-elementor-addons' ); ?>">
										<?php
										foreach ( $element_group['input_box'] as $key => $element ) {
											$value = $element_group['widget_type'] == 'pro' && $sky_pro_init !== true ? '' : esc_attr( $element['value'] );
											?>
											<div class="sa-input-group">
												<label class="sa-d-flex sa-form-label sa-mb-3"
													for="sky_input_options[<?php echo esc_attr( $element['name'] ); ?>]">
													<?php echo esc_attr( $element['label'] ); ?>
												</label>
												<?php
												printf(
													'<input id="sky_input_options[%s]" type="text" placeholder="%s" name="sky_input_options[%s]" value="%s" class="sa-w-100 sa-form-control sa-p-2 sa-rounded" %s>',
													esc_attr( $element['name'] ),
													esc_attr( $element['placeholder'] ),
													esc_attr( $element['name'] ),
													esc_html( $value ),
													esc_attr( $pro_check )

												);
												?>
												<p>
													<?php echo esc_attr( $element['description'] ); ?>
												</p>
											</div>
											<?php
										}
										?>
									</div>
									<?php
								}
								?>
							</div>
							<!-- /container -->

							<p class="sa-option-submit sa-anim-btn-1 sa-py-3">
								<button type="submit" class="button button-primary">
									<?php esc_html_e( 'Save Settings', 'sky-elementor-addons' ); ?>
								</button>
							</p>
						</form>
					</div>
					<div id="tab-analytics-used-widgets" class="tab-pane">
						<form class="sky-option-form" id="sky_opt_analytics" method="post"
							action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
							<input type="hidden" name="sky_input_options[option_page]" value="sky_addons_inactive_widgets">
							<input type="hidden" name="action" value="sky_save_option_data">
							<?php wp_nonce_field( "skyoption" ); ?>
							<div class="sa-section-action sa-mb-3 sa-mb-3">

								<?php apply_filters( 'sky_allow_tracker_notice', false ); ?>

								<div class="sa-d-flex sa-align-items-center sa-pe-2 sa-mb-2">
									<p>
										<?php esc_html_e( 'Let’s make your streaming experience hassle-free. You can control every feature of Sky Addons by activating or deactivating from here.', 'sky-elementor-addons' ); ?>
									</p>
								</div>
								<div class="sa-btn-group sa-d-flex sa-anim-btn-1">
									<button class="sa-rounded sa-active-all-btn" type="button">
										<?php esc_html_e( 'Enable All', 'sky-elementor-addons' ); ?>
									</button>
									<button class="sa-rounded sa-deactivate-all-btn" type="button">
										<?php esc_html_e( 'Disable All', 'sky-elementor-addons' ); ?>
									</button>
								</div>
							</div>
							<!-- container -->
							<div class="sa-container-grid-widget sa-py-3">
								<?php

								foreach ( $sky_elements['sky_addons_widgets'] as $key => $element ) {
									$element['value'] = $sky_db_init['sky_addons_inactive_widgets'] !== true ? $element['default'] : $element['value'];

									$pro_check = $element['widget_type'] == 'pro' && $sky_pro_init !== true ? 'disabled' : '';

									$checked = ( 'on' == $element['value'] ) ? ' checked ' : '';

									$checked = ( $sky_pro_init !== true && $element['widget_type'] == 'pro' ) ? '' : $checked;

									$widget_class = $element['widget_type'] == 'pro' && $sky_pro_init !== true ? 'pro pro-widget' : $element['widget_type'];

									/**
									 * Ribbon Condition
									 */

									if ( $element['widget_type'] == 'pro' && $sky_pro_init !== true ) {
										$widget_class .= ' sa-ribbon';
										$ribbon_text = esc_html__( 'Pro', 'sky-elementor-addons' );
									}

									if ( str_contains( $element['content_type'], 'new' ) && ( $element['widget_type'] != 'pro' || $sky_pro_init == true ) ) {
										$widget_class .= ' sa-ribbon';
										$ribbon_text = esc_html__( 'New', 'sky-elementor-addons' );
									}

									/**
									 * Analytics Setup
									 * Condition applied in reverse thinking
									 * @since 1.0.6
									 */
									$used_widgets = $sky_addons_admin->get_used_widgets_obj();
									$widget_name = 'sky-' . $element['name'];
									$unused_widget = ( in_array( $widget_name, array_keys( $used_widgets ) ) ? '' : ' sa-d-none' );
									$widget_class .= $unused_widget;

									/**
									 * Analytics Setup
									 * Counting total uses of Widgets
									 * @since 1.0.6
									 */

									$used_widgets_count = 0;


									if ( isset( $used_widgets ) ) {
										$used_widgets_count = ( in_array( $widget_name, array_keys( $used_widgets ) ) ? $used_widgets[ $widget_name ] : 0 );
									}



									?>
									<div
										class="sa-grid-col sa-grid-item sa_widget_item sa-d-flex sa-align-items-center sa-justify-content-between sa-p-4 <?php echo esc_attr( $widget_class ); ?> sa-ribbon-left"
										data-ribbon="<?php echo esc_html( $ribbon_text ); ?>">
										<div class="sa-icon-wrap sa-me-2">
											<i class="sky-icon-<?php echo esc_attr( $element['name'] ); ?>"></i>
										</div>
										<div class="sa-w-100">
											<div class="sa-item-text sa-d-flex sa-align-items-center">
												<?php echo esc_attr( $element['label'] ); ?>
												<a class="sa-demo-link-icon sa-d-inline-block sa-mx-2 sa-text-decoration-none" target="_blank"
													title="<?php esc_html_e( 'See Demo', 'sky-elementor-addons' ); ?>"
													href="<?php echo esc_url( $element['demo_url'] ); ?>">
													<i class="dashicons dashicons-desktop"></i>
												</a>
											</div>
											<small title="Total Used">
												Used -
												<?php echo esc_html( sprintf( "%02d", $used_widgets_count ) ); ?>
											</small>
										</div>
										<div class="sa-item-switcher sa-ms-2">
											<div class="sa-toggle">
												<?php
												printf(
													'<input type="hidden" value="off" name="sky_input_options[%s]" %s>',
													esc_attr( $element['name'] ),
													esc_attr( $pro_check )
												);

												/**
												 * Analytics Setup
												 * Extra suffix (id) added - analytics
												 * Solved ID conflict of checkbox
												 * @since 1.0.6
												 */
												printf(
													'<input type="checkbox" id="sky_input_options-analytics-used[%s]" name="sky_input_options[%s]" value="on" class="sa-checkbox" %s %s>',
													esc_attr( $element['name'] ),
													esc_attr( $element['name'] ),
													esc_attr( $checked ),
													esc_attr( $pro_check )
												);

												?>

												<label for="sky_input_options-analytics-used[<?php echo esc_attr( $element['name'] ); ?>]">
													<div></div>
												</label>
											</div>
										</div>
									</div>
									<?php
								}
								?>

							</div>
							<!-- /container -->
							<p class="sa-option-submit sa-anim-btn-1 sa-py-3">
								<button type="submit" class="button button-primary">
									<?php esc_html_e( 'Save Settings', 'sky-elementor-addons' ); ?>
								</button>
							</p>
						</form>
					</div>
					<div id="tab-analytics-unused-widgets" class="tab-pane">
						<form class="sky-option-form" id="sky_opt_analytics" method="post"
							action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
							<input type="hidden" name="sky_input_options[option_page]" value="sky_addons_inactive_widgets">
							<input type="hidden" name="action" value="sky_save_option_data">
							<?php wp_nonce_field( "skyoption" ); ?>
							<div class="sa-section-action sa-mb-3 sa-mb-3">

								<?php apply_filters( 'sky_allow_tracker_notice', false ); ?>

								<div class="sa-d-flex sa-align-items-center sa-pe-2 sa-mb-2">
									<p>
										<?php esc_html_e( 'Let’s make your streaming experience hassle-free. You can control every feature of Sky Addons by activating or deactivating from here.', 'sky-elementor-addons' ); ?>
									</p>
								</div>
								<div class="sa-btn-group sa-d-flex sa-anim-btn-1">
									<button class="sa-rounded sa-active-all-btn" type="button">
										<?php esc_html_e( 'Enable All', 'sky-elementor-addons' ); ?>
									</button>
									<button class="sa-rounded sa-deactivate-all-btn" type="button">
										<?php esc_html_e( 'Disable All', 'sky-elementor-addons' ); ?>
									</button>
								</div>
							</div>
							<!-- container -->
							<div class="sa-container-grid-widget sa-py-3">
								<?php

								foreach ( $sky_elements['sky_addons_widgets'] as $key => $element ) {
									$element['value'] = $sky_db_init['sky_addons_inactive_widgets'] !== true ? $element['default'] : $element['value'];

									$pro_check = $element['widget_type'] == 'pro' && $sky_pro_init !== true ? 'disabled' : '';

									$checked = ( 'on' == $element['value'] ) ? ' checked ' : '';

									$checked = ( $sky_pro_init !== true && $element['widget_type'] == 'pro' ) ? '' : $checked;

									$widget_class = $element['widget_type'] == 'pro' && $sky_pro_init !== true ? 'pro pro-widget' : $element['widget_type'];

									/**
									 * Ribbon Condition
									 */

									if ( $element['widget_type'] == 'pro' && $sky_pro_init !== true ) {
										$widget_class .= ' sa-ribbon';
										$ribbon_text = esc_html__( 'Pro', 'sky-elementor-addons' );
									}

									if ( str_contains( $element['content_type'], 'new' ) && ( $element['widget_type'] != 'pro' || $sky_pro_init == true ) ) {
										$widget_class .= ' sa-ribbon';
										$ribbon_text = esc_html__( 'New', 'sky-elementor-addons' );
									}

									/**
									 * Analytics Setup
									 * Condition applied in reverse thinking
									 * @since 1.0.6
									 */
									$used_widgets = $sky_addons_admin->get_used_widgets_obj();
									$widget_name = 'sky-' . $element['name'];
									$unused_widget = ( in_array( $widget_name, array_keys( $used_widgets ) ) ? ' sa-d-none' : '' );
									$widget_class .= $unused_widget;
									?>
									<div
										class="sa-grid-col sa-grid-item sa_widget_item sa-d-flex sa-align-items-center sa-justify-content-between sa-p-4 <?php echo esc_attr( $widget_class ); ?> sa-ribbon-left"
										data-ribbon="<?php echo esc_html( $ribbon_text ); ?>">
										<div class="sa-icon-wrap sa-me-2">
											<i class="sky-icon-<?php echo esc_attr( $element['name'] ); ?>"></i>
										</div>
										<div class="sa-w-100">
											<div class="sa-item-text sa-d-flex sa-align-items-center">
												<?php echo esc_attr( $element['label'] ); ?>
												<a class="sa-demo-link-icon sa-d-inline-block sa-mx-2 sa-text-decoration-none" target="_blank"
													title="<?php esc_html_e( 'See Demo', 'sky-elementor-addons' ); ?>"
													href="<?php echo esc_url( $element['demo_url'] ); ?>">
													<i class="dashicons dashicons-desktop"></i>
												</a>
											</div>
										</div>
										<div class="sa-item-switcher sa-ms-2">
											<div class="sa-toggle">
												<?php
												printf(
													'<input type="hidden" value="off" name="sky_input_options[%s]" %s>',
													esc_attr( $element['name'] ),
													esc_attr( $pro_check )
												);

												/**
												 * Analytics Setup
												 * Extra suffix (id) added - analytics
												 * Solved ID conflict of checkbox
												 * @since 1.0.6
												 */
												printf(
													'<input type="checkbox" id="sky_input_options-analytics-unused[%s]" name="sky_input_options[%s]" value="on" class="sa-checkbox" %s %s>',
													esc_attr( $element['name'] ),
													esc_attr( $element['name'] ),
													esc_attr( $checked ),
													esc_attr( $pro_check )
												);

												?>

												<label for="sky_input_options-analytics-unused[<?php echo esc_attr( $element['name'] ); ?>]">
													<div></div>
												</label>
											</div>
										</div>
									</div>
									<?php
								}
								?>

							</div>
							<!-- /container -->
							<p class="sa-option-submit sa-anim-btn-1 sa-py-3">
								<button type="submit" class="button button-primary">
									<?php esc_html_e( 'Save Settings', 'sky-elementor-addons' ); ?>
								</button>
							</p>
						</form>
					</div>
					<div id="tab-pro" class="tab-pane">
						<div class="sa-get-pro-welcome sa-welcome-section sa-d-flex sa-align-items-center sa-p-4"
							data-ribbon="OFFER ONGOING">
							<div class="sa-welcome-overlay"
								style="background-image: url('<?php echo esc_url( SKY_ADDONS_ASSETS_URL ) . 'images/dashboard-rocket-hero-section-2.jpg'; ?>');">
							</div>
							<div class="sa-content sa-d-flex sa-align-items-center sa-py-4">
								<div>
									<h4 class="sa-title sa-mb-3 sa-mt-0">
										<?php esc_html_e( 'Why Pro?', 'sky-elementor-addons' ); ?>
									</h4>
									<p>
										<?php esc_html_e( 'No restrictions on the number of features, widgets, or CSS styles.', 'sky-elementor-addons' ); ?>
										<br>
										<?php esc_html_e( 'We have a lot of extra features that will allow the user to have a better experience.', 'sky-elementor-addons' ); ?>
									</p>

								</div>
							</div>
						</div>
						<div class="sa-mt-4">
							<div class="sa-comparison">
								<table>
									<thead>
										<tr>
											<th class="tl tl2"></th>
											<th class="sa-product-heading free">
												<?php esc_html_e( 'Free', 'sky-elementor-addons' ); ?>
											</th>
											<th class="sa-product-heading pro">
												<?php esc_html_e( 'Pro', 'sky-elementor-addons' ); ?>
											</th>
										</tr>
										<tr>
											<th></th>
											<th class="price-info">
												<div class="price-now"><span>$0</span>
													<p>  / 
														<?php esc_html_e( 'year', 'sky-elementor-addons' ); ?>
													</p>
												</div>
											</th>
											<th class="price-info">
												<div class="price-now"><span>$</span>
													<p>  /
														<?php esc_html_e( 'year', 'sky-elementor-addons' ); ?>
													</p>
												</div>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td></td>
											<td colspan="3">
												<?php esc_html_e( 'Dashboard', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr class="compare-row">
											<td>
												<?php esc_html_e( 'Dashboard', 'sky-elementor-addons' ); ?>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
										</tr>
										<tr>
											<td></td>
											<td colspan="3">
												<?php esc_html_e( 'Features', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php esc_html_e( 'Features', 'sky-elementor-addons' ); ?>
											</td>
											<td>
												<span>
													<?php esc_html_e( 'Limited', 'sky-elementor-addons' ); ?>
												</span>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
										</tr>
										<tr>
											<td></td>
											<td colspan="3">
												<?php esc_html_e( 'API Data', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr class="compare-row">
											<td>
												<?php esc_html_e( 'API Data', 'sky-elementor-addons' ); ?>
											</td>
											<td>
												<span>
													<?php esc_html_e( 'Limited', 'sky-elementor-addons' ); ?>
												</span>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
										</tr>
										<tr>
											<td> </td>
											<td colspan="3">
												<?php esc_html_e( 'Widgets', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php esc_html_e( 'Widgets', 'sky-elementor-addons' ); ?>
											</td>
											<td>
												<span>
													<?php esc_html_e( 'Free', 'sky-elementor-addons' ); ?>
												</span>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
										</tr>
										<tr>
											<td> </td>
											<td colspan="3">
												<?php esc_html_e( 'Extensions', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr class="compare-row">
											<td>
												<?php esc_html_e( 'Extensions', 'sky-elementor-addons' ); ?>
											</td>
											<td>
												<span>
													<?php esc_html_e( 'Free', 'sky-elementor-addons' ); ?>
												</span>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
										</tr>
										<tr>
											<td> </td>
											<td colspan="3">
												<?php esc_html_e( 'Dynamic Content', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php esc_html_e( 'Dynamic Content', 'sky-elementor-addons' ); ?>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
										</tr>
										<tr>
											<td> </td>
											<td colspan="3">
												<?php esc_html_e( 'Custom Fields', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr class="compare-row">
											<td>
												<?php esc_html_e( 'Custom Fields', 'sky-elementor-addons' ); ?>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
										</tr>
										<tr>
											<td> </td>
											<td colspan="4">
												<?php esc_html_e( 'Documentation', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php esc_html_e( 'Documentation', 'sky-elementor-addons' ); ?>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
										</tr>
										<tr>
											<td> </td>
											<td colspan="3">
												<?php esc_html_e( 'Updates & Support', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr class="compare-row">
											<td>
												<?php esc_html_e( 'Updates & Support', 'sky-elementor-addons' ); ?>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
										</tr>
										<tr>
											<td> </td>
											<td colspan="3">
												<?php esc_html_e( 'Special support', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php esc_html_e( 'Special support', 'sky-elementor-addons' ); ?>
											</td>
											<td>
												<span>–</span>
											</td>
											<td>
												<i class="dashicons dashicons-yes"></i>
											</td>
										</tr>
										<tr>
											<td> </td>
											<td colspan="3">
												<?php esc_html_e( 'Manual Update', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr class="compare-row">
											<td>
												<?php esc_html_e( 'Manual Update', 'sky-elementor-addons' ); ?>
											</td>
											<td><span>–</span></td>
											<td><i class="dashicons dashicons-yes"></i>
											</td>
										</tr>
										<tr>
											<td> </td>
											<td colspan="3">
												<?php esc_html_e( 'Comments', 'sky-elementor-addons' ); ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php esc_html_e( 'Note', 'sky-elementor-addons' ); ?>
											</td>
											<td colspan="3">
												<div class="sa-p-2 sa-note">
													<?php esc_html_e( 'Regular updates and other goodies to make sure you never get stuck for a solution.', 'sky-elementor-addons' ); ?>
													<br>
													<?php esc_html_e( 'We will recommend you to use the Pro version.', 'sky-elementor-addons' ); ?>
												</div>
											</td>
										</tr>
										<tr>
											<td> </td>
										</tr>
										<tr>
											<td></td>
											<td>
												<a href="https://wordpress.org/plugins/sky-elementor-addons/" target="_blank"
													class="price-buy sa-anim-btn-1">
													<?php esc_html_e( 'Download', 'sky-elementor-addons' ); ?><span class="hide-mobile"></span>
												</a>
											</td>
											<td>
												<a href="https://skyaddons.com" target="_blank" class="price-buy sa-anim-btn-1">
													<?php esc_html_e( 'Buy Now', 'sky-elementor-addons' ); ?><span class="hide-mobile"></span>
												</a>
											</td>
										</tr>
									</tbody>
								</table>
								<div class="sa-m-4">
									<p>
										<?php
										esc_html_e( '<i>We have a <b>30 day money-back guarantee</b>, meaning that you can try our product for a month <br> and if you don\'t love it, we\'ll refund your purchase.</i>', 'sky-elementor-addons' );
										?>
									</p>
								</div>
							</div>
						</div>

					</div>
					<!-- <div id="tab-about" class="tab-pane">
						<h3>About</h3>
					</div> -->
				</div>
			</div>
		</div>
		<?php $sky_addons_admin::sky_dashboard_footer(); ?>


	</div>
</div>
