<?php

namespace core;

$dirs = array (
    'core/Services/*',
    'core/Constants/*'
);

foreach($dirs as $classes)
{
	foreach(glob($classes) as $class)
		require_once $class;
}
