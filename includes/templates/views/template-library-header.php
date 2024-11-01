<?php $logo = trailingslashit( plugin_dir_url( SKY_ADDONS__FILE__ ) ) . '/includes/templates/assets/templates-library-logo.svg'; ?>
<script type="text/template" id="sa-skyTemplatesLibrary_header-logo">
	<span class="skyTemplatesLibrary_logo-wrap">
		<img src="<?php echo esc_url( $logo ); ?>" alt="SkyAddons Logo" style="height: 30px;">
	</span>
		<span class="skyTemplatesLibrary_logo-title" style="margin-left: 18px;">{{{ title }}}</span>
</script>

<script type="text/template" id="sa-skyTemplatesLibrary_header-back">
	<i class="eicon-" aria-hidden="true"></i>
	<span><?php esc_html_e( 'Back to Library', 'sky-elementor-addons' ); ?></span>
</script>

<script type="text/template" id="sa-skyTemplatesLibrary_header-menu">
	<# _.each( tabs, function( args, tab ) { var activeClass = args.active ? 'elementor-active' : ''; #>
		<div class="elementor-component-tab elementor-template-library-menu-item {{activeClass}}" data-tab="{{{ tab }}}">{{{ args.title }}}</div>
	<# } ); #>
</script>

<script type="text/template" id="sa-skyTemplatesLibrary_header-menu-responsive">

</script>

<script type="text/template" id="sa-skyTemplatesLibrary_header-actions">
	<div id="skyTemplatesLibrary_header-sync" class="elementor-templates-modal__header__item">
		<i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e( 'Sync Library', 'sky-elementor-addons' ); ?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Sync Library', 'sky-elementor-addons' ); ?></span>
	</div>
</script>
