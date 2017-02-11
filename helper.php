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
