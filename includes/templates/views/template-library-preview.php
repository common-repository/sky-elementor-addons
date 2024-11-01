<script type="text/template" id="sa-skyTemplatesLibrary_preview">
	<iframe class="skyTemplatesLibrary_template-preview-thumbnail"></iframe>
</script>

<script type="text/template" id="sa-skyTemplatesLibrary_header-insert">
	<div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item">
		<a href="{{ liveurl }}" target="_blank" class="elementor-template-library-template-action header-live-preview">
			<i class="eicon-editor-external-link" aria-hidden="true"></i>
			<?php esc_html_e('Live Preview', 'sky-elementor-addons'); ?>
		</a>
		{{{ skyAddons.library.getModal().getTemplateActionButton( obj ) }}}
	</div>
</script>