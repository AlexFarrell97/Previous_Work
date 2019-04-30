<?php

	//check all inputs from the form and turn them into html entities to avoid sql injection
	function escape($string) {
		return htmlentities($string, ENT_QUOTES, 'UTF-8');
	}                                
                            