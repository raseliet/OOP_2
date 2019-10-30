<?php
require 'validators.php';
/**
 * Sanitizes all form inputs
 * @param array $form
 * @return array
 */
function get_filtered_input($form) {
	$filter_parameters = [];
	foreach ($form['fields'] as $field_id => $field) {
		$filter_parameters[$field_id] = $field['filter'] ?? FILTER_SANITIZE_SPECIAL_CHARS;
	}
	return filter_input_array(INPUT_POST, $filter_parameters);
}
function get_form_action() {
	return filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
}
/**
 * Kviecia validatorius kiekvienam formos field'ui.
 * @param array $filtered_input
 * @param array $form
 * @return boolean
 */
function validate_form($filtered_input, &$form) {
	$success = true;
	if (isset($form['fields'])) {
		foreach ($form['fields'] as $field_id => &$field) {
			$field_input = $filtered_input[$field_id];
			$field['value'] = $field_input;
			foreach ($field['validators'] ?? [] as $validator) {
				$is_valid = $validator($field_input, $field);
				if (!$is_valid) {
					$success = false;
					break;
				}
			}
		}
	}
	if ($success) {
		foreach ($form['validators'] ?? [] as $validator) {
			$is_valid = $validator($filtered_input, $form);
			if (!$is_valid) {
				$success = false;
				break;
			}
		}
	}
	if ($success) {
		if (isset($form['callbacks']['success'])) {
            $form['callbacks']['success']($filtered_input, $form);
        }
    } else {
        if (isset($form['callbacks']['fail'])) {
            $form['callbacks']['fail']($filtered_input, $form);
        }
    }
    return $success;
}
