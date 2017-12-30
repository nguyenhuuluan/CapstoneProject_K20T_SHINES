<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link href="{{asset('assets/vendors/bootsrap/css/bootstrap.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendors/bootsrap/css/bootstrap.min.css')}}" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
	<h1>tesst</h1>
	<div class="ui-widget">
		<label for="tags">Tags: </label>
		<input id="tags">
	</div>
</body>
<script>
	$( function() {
		var availableTags = [
		"ActionScript",
		"AppleScript",
		"Asp",
		"BASIC",
		"C",
		"C++",
		"Clojure",
		"COBOL",
		"ColdFusion",
		"Erlang",
		"Fortran",
		"Groovy",
		"Haskell",
		"Java",
		"JavaScript",
		"Lisp",
		"Perl",
		"PHP",
		"Python",
		"Ruby",
		"Scala",
		"Scheme"
		];
		$( "#tags" ).autocomplete({
			source: '{!! URL::route('searchtag') !!}'
		});
	} );
</script>
</html>