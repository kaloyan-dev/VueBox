(function() {

	Vue.directive( 'sortable', function( value ) {
		var that = this;
		var key  = this.arg;

		value = value || {};
		value.onUpdate = function( e ) {
			var vm     = that.vm;
			var array  = vm[ key ];
			var target = array[ e.oldIndex ];

			array.$remove( target );
			array.splice( e.newIndex, 0, target );
			vm.$emit( 'sort', target, e.oldIndex, e.newIndex );
		};

		Sortable.create( this.el, value );
	});

	var VueBoxContainers = document.getElementsByClassName( 'vuebox-container' );

	for ( var i = 0; i < VueBoxContainers.length; i++ ) {

		var VueBoxContainerSelector = '#' + VueBoxContainers[i].id;

		new Vue({

			el: VueBoxContainerSelector

		});
	}

})();