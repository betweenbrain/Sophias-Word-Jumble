<?php

$words = file_get_contents(getcwd() . '/words.txt');

$words = explode("\n", $words);

// Shuffles the words
shuffle($words);

// Get only first word
$word = strtolower($words[0]);

// Convert word into an array
$jumble = str_split($word);

// Shuffle letters in jumble
shuffle($jumble);

// Set variables based on posted data, or not
$correct = (isset($_POST['correct'])) ? filter_input(INPUT_POST, 'correct', FILTER_SANITIZE_NUMBER_INT) : null;
$guesses = (isset($_POST['guesses'])) ? filter_input(INPUT_POST, 'guesses', FILTER_SANITIZE_NUMBER_INT) : null;
$hints = (isset($_POST['hint'])) ? filter_input(INPUT_POST, 'hints', FILTER_SANITIZE_NUMBER_INT) : null;

$message = 'Take a guess!';

if (isset($_POST['guess']))
{
	if (strtolower(filter_input(INPUT_POST, 'guess', FILTER_SANITIZE_STRING)) === filter_input(INPUT_POST, 'word', FILTER_SANITIZE_STRING))
	{
		$correct++;
		unset($_POST['word']);
		unset($_POST['jumble']);
		$message = 'Woo hoo!';
	}
	else
	{
		$message = 'Try again';
	}
}

echo '<h1>' . $message . '</h1>';

if (isset($_POST['hint']))
{
	$hints++;
	echo '<p>Hint: ' . htmlspecialchars(substr($_POST['word'], 0, $hints)) . '</p>';
}

if (isset($_POST['hint']) || isset($_POST['attempt']))
{
	$guesses++;
	echo '<p>' . number_format(($correct / $guesses) * 100, 2) . '% correct</p>';

}

$_POST['jumble'] = (isset($_POST['jumble'])) ? filter_input(INPUT_POST, 'jumble', FILTER_SANITIZE_STRING) : implode($jumble);
$_POST['word'] = (isset($_POST['word'])) ? filter_input(INPUT_POST, 'word', FILTER_SANITIZE_STRING) : $word;

echo '<p>The scramble is: <em>' . htmlspecialchars($_POST['jumble']) . '</em></p>';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		html {
			font-size: 3em;
			color: #444;
		}

		body {
			width: 403px;
			margin: 0 auto;
			text-align: center;
		}

		input {
			font-size: .75em;
			width: 7em;
			color: #444;
		}

		.error {
			color: red;
		}

		em {
			display: block;
		}
	</style>
</head>
<body>
<form action="" method="post">
	<input type="text" name="guess" autofocus="autofocus"/>
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