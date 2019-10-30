<?php
function validate_not_empty($field_input, &$field) {
    if ($field_input === '') {
        $field['error'] = 'Laukas negali būti tuščias!';
		return false;
    }
	
	return true;
}
function validate_is_number($field_input, &$field) {
    if (!is_numeric($field_input)) {
        $field['error'] = 'Įveskite skaičių!';
		return false;
    }
	
	return true;
}
function validate_max_100($field_input, &$field) {
    if ($field_input > 100) {
        $field['error'] = 'Per daug metų!';
		return false;
    }
	
	return true;
}
function validate_is_positive($field_input, &$field) {
    if ($field_input < 0) {
        $field['error'] = 'Įveskite teigiamą skaičių!';
		return false;
    }
	
	return true;
}
function validate_password($field_input, &$field) {
    if (strlen($field_input) < 8) {
        $field['error'] = 'Įveskite daugiau nei 8 simbolius!';
		return false;
    }
	
	return true;
}

