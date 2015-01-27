<?php defined('_FOOEXEC') or die;

/**
 * File       template.php
 * Created    2/11/14 2:28 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2014 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v3 or later
 */

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		html {
			font-size : 3em;
			color     : #444;
		}

		body,
		form {
			max-width  : 803px;
			margin     : 0 auto;
			text-align : center;
		}

		form {
			max-width : 403px;
		}

		input {
			font-size : .75em;
			width     : 7em;
			color     : #444;
		}

		.error {
			color : red;
		}

		em {
			display : block;
		}
	</style>
</head>
<body>
<h1><?php echo $message ?></h1>
<?php echo '<p>The scramble is: <em>' . $jumble . '</em></p>'; ?>
<form action="" method="post">
	<input type="text" name="guess" autofocus="autofocus" autocomplete="off" />
	<input type="hidden" name="word" value="<?php echo $_POST['word'] ?>">
	<input type="hidden" name="jumble" value="<?php echo $_POST['jumble'] ?>">
	<input type="hidden" name="guesses" value="<?php echo $guesses ?>">
	<input type="hidden" name="correct" value="<?php echo $correct ?>">
	<input type="hidden" name="hints" value="<?php echo $hints ?>">
	<input type="submit" name="attempt" value="Try!">
	<input type="submit" name="hint" value="I need a hint">
</form>
<a href="https://twitter.com/share" class="twitter-share-button"
	data-text="I scored <?php echo $correct ?> correct out of <?php echo $guesses ?> guesses of jumbled words at"
	data-via="betweenbrain" data-hashtags="SophiasWordJumble">Tweet</a>
<script>!function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
		if (!d.getElementById(id)) {
			js = d.createElement(s);
			js.id = id;
			js.src = p + '://platform.twitter.com/widgets.js';
			fjs.parentNode.insertBefore(js, fjs);
		}
	}(document, 'script', 'twitter-wjs');</script>
<script>
	(function (i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] || function () {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o),
			m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-2493745-48', 'sophiayanira.com');
	ga('send', 'pageview');

</script>
</body>
</html>