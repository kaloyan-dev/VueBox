<vuebox-repeater inline-template title="<?php echo $title; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" caption="<?php echo $caption; ?>" :fieldsets="<?php echo $fieldsets; ?>" :fieldsdata='<?php echo json_encode( $subfields_data ); ?>'>
	<div class="vuebox-field vuebox-field-repeater">
		<input type="hidden" name="{{ name }}[]" />
		<div class="vuebox-field-title">{{ title }}</div>
		<div class="vuebox-repeater-children" v-sortable:fieldsets">
			<?php for ( $i = 0; $i < $fieldsets; $i++ ): ?>
				<div class="vuebox-repeater-fieldwrap">
					<span class="vuebox-fieldwrap-handle"><i class="fa fa-arrows-v"></i></span>
					<?php
						foreach ( $subfields as $subfield ):
							vuebox_render_field( $subfield, $post_fields, $name, $i );
						endforeach;
					?>
				</div>
			<?php endfor; ?>
			<div class="vuebox-repeater-fieldwrap" v-for="n in newsets">
				<span class="vuebox-fieldwrap-handle"><i class="fa fa-arrows-v"></i></span>
				<?php
					foreach ( $subfields as $subfield ):
						vuebox_render_field( $subfield, $post_fields, $name, '{FIELDSET_INDEX}' );
					endforeach;
				?>
			</div>
		</div>
		<div class="vuebox-repeater-actions">
			<a href="#" @click.prevent="addFieldset"><?php _e( 'Add Entry', 'vuebox' ); ?></a>
		</div>
		<p v-if="caption" class="vuebox-caption">{{ caption }}</p>
	</div>
</vuebox-repeater>