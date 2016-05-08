<vuebox-image inline-template title="<?php echo $title; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" caption="<?php echo $caption; ?>" url="<?php echo $url; ?>">
	<div class="vuebox-field vuebox-field-image">
		<div class="vuebox-field-title">
			<label>{{ title }}</label>
		</div>
		<input name="{{ name }}" type="hidden" value="{{ value }}">
		<div class="vuebox-image-preview" v-if="url">
			<img :src="url" alt="" />			
		</div>
		<input type="button" class="button button-primary" value="<?php _e( 'Select', 'vuebox' ); ?>" @click.prevent="pickImage" />
		<input v-if="url" type="button" class="button" value="<?php _e( 'Remove', 'vuebox' ); ?>" @click.prevent="removeImage" />
		<p v-if="caption" class="vuebox-caption">{{ caption }}</p>
	</div>	
</vuebox-image>