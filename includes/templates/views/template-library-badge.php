<script type="text/template" id="sa-skyTemplatesLibrary_templates">
	<div id="skyTemplatesLibrary_toolbar">
		<div id="skyTemplatesLibrary_toolbar-search">
			<label for="skyTemplatesLibrary_search" class="elementor-screen-only"><?php esc_html_e('Search Templates:', 'sky-elementor-addons'); ?></label>
			<input id="skyTemplatesLibrary_search" placeholder="<?php esc_attr_e('Search', 'sky-elementor-addons'); ?>">
			<i class="eicon-search"></i>
		</div>
		<div id="skyTemplatesLibrary_toolbar-counter"></div>
		
		<div id="skyTemplatesLibrary_toolbar-filter" class="skyTemplatesLibrary_toolbar-filter">
			<# if (skyAddons.library.getTypeTags()) { var selectedTag = skyAddons.library.getFilter( 'tags' ); #>
				<# if ( selectedTag ) { #>
				<span class="skyTemplatesLibrary_filter-btn">{{{ skyAddons.library.getTags()[selectedTag] }}} <i class="eicon-caret-right"></i></span>
				<# } else { #>
				<span class="skyTemplatesLibrary_filter-btn"><?php esc_html_e('Filter', 'sky-elementor-addons'); ?> <i class="eicon-caret-right"></i></span>
				<# } #>
				<ul id="skyTemplatesLibrary_filter-tags" class="skyTemplatesLibrary_filter-tags">
					<li data-tag="">All</li>
					<# _.each(skyAddons.library.getTypeTags(), function(slug) {
						var selected = selectedTag === slug ? 'active' : '';
						#>
						<li data-tag="{{ slug }}" class="{{ selected }}">{{{ skyAddons.library.getTags()[slug] }}}</li>
					<# } ); #>
				</ul>
			<# } #>
		</div>
	</div>

	<div class="skyTemplatesLibrary_templates-window">
		<div id="skyTemplatesLibrary_templates-list"></div>
	</div>
</script>