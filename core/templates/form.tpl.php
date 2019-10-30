<?php if (isset($form) && !empty($form)): ?>
	<form <?php print html_attr(($form['attr'] ?? []) + ['method' => 'POST']); ?>>

		<!--Form Title-->	
		<?php if (isset($form['title'])): ?>
			<h2><?php print $form['title']?></h2>
		<?php endif; ?>

		<!--Start Field Generation-->
		<?php foreach ($form['fields'] ?? [] as $field_id => $field): ?>
			<div class="field-container">

				<!--Label-->
				<?php if (isset($field['label'])): ?>
					<label>
						<span class="label"><?php print $field['label']; ?></span>
				<?php endif; ?>

				<!--Field-->
				<?php if ($field['type'] === 'select'): ?>
					<select <?php print html_attr(['name' => $field_id] + ($field['extra']['attr'] ?? [])); ?>>
						<?php foreach ($field['options'] as $option_id => $option): ?>
							<option value="<?php print $option_id; ?>" <?php print ($field['value'] ?? null) === $option_id ? 'selected' : ''; ?>>
								<?php print $option; ?>
							</option>
						<?php endforeach; ?>
					</select>
				<?php else: ?>
					<input <?php print html_attr(['name' => $field_id, 'type' => $field['type'], 'value' => $field['value'] ?? ''] + ($field['extra']['attr'] ?? [])); ?>>
				<?php endif; ?>

				<?php if (isset($field['label'])): ?>
					</label>
				<?php endif; ?>

				<!--Error-->
				<div class="error">
					<?php if (isset($field['error'])): ?>
						<span>
							<?php print $field['error']; ?>
						</span>
					<?php endif; ?>
				</div>

			</div>
		<?php endforeach; ?>
		<!--End Field Generation-->

		<!--Start Button Generation-->
		<?php if (isset($form['buttons'])): ?>
			<?php foreach ($form['buttons'] as $button_id => $button): ?>
				<div class="button-container">
					<input <?php print html_attr(['name' => 'action', 'value' => $button_id] + $button); ?>>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<!--End button Generation-->

		<!--Form Message-->	
		<?php if (isset($form['message'])): ?>
			<div class="message">
				<span><?php print $form['message']?></span>
			</div>
		<?php endif; ?>
	</form>
<?php endif; ?>

