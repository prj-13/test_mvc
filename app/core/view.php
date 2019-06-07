<?php
class View
{
	//public $template_view; // здесь можно указать общий вид по умолчанию.

	function generate($content_view, $temp_view, $data = null)
	{
		include 'app/view/'.$temp_view;
	}
}
?>
