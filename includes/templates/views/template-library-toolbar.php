<script type="text/template" id="sa-skyTemplatesLibrary_template">
	<div class="skyTemplatesLibrary_template-body" id="liteTemplate-{{ template_id }}">
		<div class="skyTemplatesLibrary_template-preview">
			<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
		</div>
		<img class="skyTemplatesLibrary_template-thumbnail" src="{{ thumbnail }}">
		<# if ( obj.isPro ) { #>
		<span class="skyTemplatesLibrary_template-badge"><?php esc_html_e('Pro', 'sky-elementor-addons'); ?></span>
		<# } #>
		<div class="skyTemplatesLibrary_template-name">{{{ title }}}</div>
	</div>
	<div class="skyTemplatesLibrary_template-footer">
		{{{ skyAddons.library.getModal().getTemplateActionButton( obj ) }}}

	</div>
</script>