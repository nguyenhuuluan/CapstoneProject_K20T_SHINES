<?php

function create($class, $attributes = [], $times = null)
{
	return factory($class)->create($attributes);
}

function make($class, $attributes = [], $times = null)
{
	return factory($class)->make($attributes);
}

