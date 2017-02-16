<?php

/**
 * Change the keys of a array
 * @param  array $array       The original array
 * @param  array $keys_change An array with keys to be changed and new keys
 * @return array
 */
function array_keys_change($array, $keys_change)
{
	$values = array_values($array);

	$keys = array_map(function($key) use ($keys_change) {
		$find = array_search($key, array_keys($keys_change));

		if (false !== $find)
			return array_values($keys_change)[$find];

		return $key;
	}, array_keys($array));

	return array_combine($keys, $values);
}

/**
 * Change the date to a new format
 * @param  string $date
 * @param  string $original_format
 * @param  string $new_format
 * @return string 
 */
function format_date($date, $new_format, $original_format = 'dd/mm/yyyy')
{
	switch (strtolower($original_format)) {
		case 'dd/mm/yyyy':
		case 'dd-mm-yyyy':
			list($day, $month, $year) = preg_split('/[-.\/ ]/', $date);
			break;

	 	case 'yyyy/dd/mm':
		case 'yyyy-dd-mm':
			list($year, $day, $month) = preg_split("/[-.\/ ]/", $date);
			break;
		
		case 'mm-dd-yyyy':
		case 'mm/dd/yyyy':
			list($month, $day, $year) = preg_split("/[-.\/ ]/", $date);
			break;

	 	case 'yyyy/mm/dd':
		case 'yyyy-mm-dd':
			list($year, $day, $month) = preg_split("/[-.\/ ]/", $date);
			break;

		case 'yyyymmdd':
			$year = substr($date, 0, 4);
			$month = substr($date, 4, 2);
			$day = substr($date, 6, 2);
			break;

		case 'yyyyddmm':
			$year = substr($date, 0, 4);
			$day = substr($date, 4, 2);
			$month = substr($date, 6, 2);
			break;

		default:
			return false;
	}

	$accepted_formats = [
		'd/m/Y',
		'm/d/Y',
		'Y/d/m',
		'd-m-Y',
		'm-d-Y',
		'Y-m-d',
		'dmY',
		'mdY',
		'Ymd'
	];
		
	if (!checkdate($month, $day, $year) || !in_array($new_format, $accepted_formats))
			return false;

	return date($new_format, strtotime(preg_replace("/\D/", '-', $date)));
}
