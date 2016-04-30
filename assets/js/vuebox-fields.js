(function() {

	/* Text */
	Vue.component( 'vuebox-text', {
		props: ['title', 'name', 'value', 'caption']
	} );

	/* Textarea */
	Vue.component( 'vuebox-textarea', {
		props: ['title', 'name', 'value', 'caption']
	} );

	/* Colorpicker */
	Vue.component( 'vuebox-colorpicker', {
		ready: function() {
			jQuery( this.$el.children[1] ).wpColorPicker();
		},

		props: ['title', 'name', 'value', 'caption']
	} );

	/* Repeater */
	Vue.component( 'vuebox-repeater', {
		props: ['title', 'name', 'value', 'children', 'caption', 'fieldsets'],
		methods: {
			addFieldset: function() {
				this.fieldsets++;
			}
		}
	} );

})();