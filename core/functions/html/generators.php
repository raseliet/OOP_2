<?php
/**
 * Generates HTML attributes
 * @param array $attr
 * @return string
 */
function html_attr($attr) {
	$html_attr_array = [];
	
	foreach ($attr as $attribute_key => $attribute_value) {
		$html_attr_array[] = strtr('@key="@value"', [
			'@key' => $attribute_key,
			'@value' => $attribute_value
		]);
	}
	
	return implode(' ', $html_attr_array);
}
