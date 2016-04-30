<vuebox-text inline-template title="<?php echo $title; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" caption="<?php echo $caption; ?>">
	<div class="vuebox-field vuebox-field-text">
		<div class="vuebox-field-title">
			<label>{{ title }}</label>
		</div>
		<input class="widefat" name="{{ name }}" type="text" value="{{ value }}">
		<p v-if="caption" class="vuebox-caption">{{ caption }}</p>
	</div>	
</vuebox-text>