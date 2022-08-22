<?php

function plugins()
{
	foreach(glob( "plugins/*") as $plugin)
	{
		$pluginList[] = pathinfo($plugin)['filename'];
	}
	return $pluginList;
}