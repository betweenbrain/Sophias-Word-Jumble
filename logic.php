<?php defined('_FOOEXEC') or die;

/**
 * File       logic.php
 * Created    2/11/14 2:35 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2014 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v3 or later
 */
class wordJumble
{

	private $word;
	private $jumble;
	private $message = 'Take a guess!';

	public function __construct()
	{
		$this->setRandonWord();
		$this->setJumbledWord();
		$this->correct = (isset($_POST['correct'])) ? filter_input(INPUT_POST, 'correct', FILTER_SANITIZE_NUMBER_INT) : null;
		$this->guesses = (isset($_POST['guesses'])) ? filter_input(INPUT_POST, 'guesses', FILTER_SANITIZE_NUMBER_INT) : null;
		$this->hints   = (isset($_POST['hint'])) ? filter_input(INPUT_POST, 'hints', FILTER_SANITIZE_NUMBER_INT) : null;
	}

	public function getJumble()
	{
		return $this->jumble;
	}

	public function getGuesses()
	{
		return $this->guesses;
	}

	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * Returns an array of words from the dictionary file
	 *
	 * @return array
	 */
	private function getWordList()
	{
		$wordList = file_get_contents(__DIR__ . '/words.txt');

		return explode("\n", $wordList);
	}

	private function setRandonWord()
	{
		$words = $this->getWordList();
		shuffle($words);

		$this->word = $words[0];
	}

	private function setJumbledWord()
	{
		$letters = str_split($this->word);
		shuffle($letters);

		$this->jumble = implode($letters);
		$this->checkJumble();
	}

	private function checkJumble()
	{
		if ($this->jumble === $this->word)
		{
			$this->setJumbledWord();
		}
	}

	// TODO: implement this stuff
	private function checkGuess()
	{

		if (isset($_POST['guess']))
		{
			if (strtolower(filter_input(INPUT_POST, 'guess', FILTER_SANITIZE_STRING)) === filter_input(INPUT_POST, 'word', FILTER_SANITIZE_STRING))
			{
				$this->correct++;
				unset($_POST['word']);
				unset($_POST['jumble']);
				$this->message = 'Correct!';
			}
			else
			{
				$this->message = 'Wrong, try again.';
			}
			$this->guesses++;
		}

		$_POST['jumble'] = (isset($_POST['jumble'])) ? filter_input(INPUT_POST, 'jumble', FILTER_SANITIZE_STRING) : $this->jumble;
		$_POST['word']   = (isset($_POST['word'])) ? filter_input(INPUT_POST, 'word', FILTER_SANITIZE_STRING) : $this->word;
	}

	private function foo()
	{

		if (isset($_POST['hint']))
		{
			$this->hints++;
			echo '<h1>Hint: ' . htmlspecialchars(substr($_POST['word'], 0, $hints)) . '</h1>';
		}

		if (isset($_POST['hint']) || isset($_POST['attempt']))
		{
			$this->guesses++;
			echo '<p>' . number_format(($correct / $guesses) * 100, 2) . '% correct</p>';

		}
	}

}
