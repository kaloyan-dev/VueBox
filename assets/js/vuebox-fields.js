(function() {

	/* Text */
	Vue.component( 'vuebox-text', {
		template: '' +
		'<div class="vuebox-field vuebox-field-text">' +
			'<div class="vuebox-field-title">' +
				'<label>{{ title }}</label>' +
			'</div>' +
			'<input class="widefat" name="{{ name }}" type="text" value="{{ value }}">' +
		'</div>',

		props: ['title', 'name', 'value']
	} );

	/* Textarea */
	Vue.component( 'vuebox-textarea', {
		template: '' +
		'<div class="vuebox-field vuebox-field-text">' +
			'<div class="vuebox-field-title">' +
				'<label>{{ title }}</label>' +
			'</div>' +
			'<textarea class="widefat" name="{{ name }}" type="text">{{ value }}</textarea>' +
		'</div>',

		props: ['title', 'name', 'value']
	} );

})();