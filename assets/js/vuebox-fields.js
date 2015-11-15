/* Text */
Vue.component( 'vuebox-text', {
	template: '<input name="{{ name }}" type="text" value="{{ value }}">',

	props: ['name','value']
} );