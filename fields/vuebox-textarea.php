<vuebox-textarea inline-template title="<?php echo $title; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" caption="<?php echo $caption; ?>">
	<div class="vuebox-field vuebox-field-textarea">
		<div class="vuebox-field-title">
			<label>{{ title }}</label>
		</div>
		<textarea class="widefat" name="{{ name }}" type="text">{{ value }}</textarea>
		<p v-if="caption" class="vuebox-caption">{{ caption }}</p>
	</div>
</vuebox-textarea>