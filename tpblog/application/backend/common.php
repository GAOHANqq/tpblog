<?php

function check_username($username)
{
	$pattern = '/^\w{4,12}$/';
	return preg_match($pattern, $username);
}

function encrypt($str)
{
	return md5($str);
}