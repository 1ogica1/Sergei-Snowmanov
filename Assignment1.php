<?php

/* Sergei the Snowman Game (hangman)
 * This file consists of Lab3 and Assignment 1 steps 1-19.
 * Author: Jasmyn Newton
 * Date: October 7th, 2014
 */


	echo "<html><link rel='stylesheet' type='text/css' href='Assignment1.css'></html>";
	echo "<title>SERGEI THE SNOWMAN GAME</title>";


// VARIABLE DECLARATIONS -----------------
	
	$CorrectWords = array(
		"russia",
		"odin",
		"dva",
		"tri",
		"koshka",
		"nyet"
		);	
		
	$CorrectWord = "";
	$CorrectWord = ($CorrectWords[array_rand($CorrectWords, 1)]);
	$CorrectWordArray = str_split($CorrectWord);	
	$WordCount = count($CorrectWords);
	
	$GuessedWord = array();
	
	$GuessedLetter = "";
	$GuessedLetters = array();
	
	$MaxAttempts = 9;
	
	$GameNumber = 1;
	
	$PlayCount = 1;
	
	$NumberOfPlayers = 2;


// FUNCTIONS -----------------------------

// FUNCTION: GUESS CONSONANT ----

	function GuessConsonant() {
		
		global $GuessedLetter, $GuessedLetters;
	
				$CLetters = "b;c;d;f;g;h;j;k;l;m;n;p;q;r;s;t;v;w;x;z;";
				$RandomNumber = rand(1, 39);

				$GuessedLetter = substr($CLetters, strpos($CLetters, ';', $RandomNumber) -1, 1);		
	}
	
	
// FUNCTION: GUESS VOWEL --------

	function GuessVowel() {
	
		global $GuessedLetter, $GuessedLetters;

				$VLetters = "a;e;i;o;u;y;";
				$RandomNumber = rand(1, 11);

				$GuessedLetter = substr($VLetters, strpos($VLetters, ';', $RandomNumber) -1, 1);
	}


// FUNCTION: GAME STRUCTURE -----

	function Structure() {
		
			
		global $CorrectWord, $CorrectWordArray, $CorrectWords, $GuessedLetter, $GuessedLetters, $GuessedWord, $MaxAttempts;
		
		$Attempt = 1;
		$IncorrectGuess = 0;
		
		do {	
			if ($Attempt % 2 !== 0) {
				do {
					if (($Attempt % 4) != 0) {
						GuessConsonant();
					} else GuessVowel();
				
				} while (in_array($GuessedLetter, $GuessedLetters));
			
				$GuessedLetters[] = $GuessedLetter;
				echo "<p><strong>>> Player 1</strong>'s Turn!</p>";
				echo "<p><strong>>></strong> Guess: $Attempt</p>";
				echo "<p><strong>>> Player 1</strong> Guessed: $GuessedLetter</p>";
			
				if (strpos($CorrectWord, $GuessedLetter) !==false) {
					echo "<p>Correct Guess</p>";

						$LetterIndex = (strpos((implode('', $CorrectWordArray)), $GuessedLetter));
						$GuessedWord[$LetterIndex] = $GuessedLetter;
					
						if ((strrpos((implode('', $CorrectWordArray)), $GuessedLetter)) != $LetterIndex) {
							$LetterIndex = (strrpos((implode('', $CorrectWordArray)), $GuessedLetter));
							$GuessedWord[$LetterIndex] = $GuessedLetter;
						} 
				} else {
							$IncorrectGuess++;
							echo "<p>Incorrect Guess: $IncorrectGuess</p>";
				}
			
				if ($IncorrectGuess <=9) {
					echo "<img src='$IncorrectGuess.png'/>";
				}
				echo "</br></br>";
				echo implode(' ', $GuessedWord);
				echo "</br></br></br>";
				echo "<p>Guessed Letters: ";
				echo implode(' ', $GuessedLetters);
				echo "</p>";
				echo "<p>------------------------</p>";
				echo "</br>";
				$Attempt++;
			} else {
				do {
					if (($Attempt % 4) != 0) {
						GuessConsonant();
					} else GuessVowel();
				
				} while (in_array($GuessedLetter, $GuessedLetters));
			
				$GuessedLetters[] = $GuessedLetter;
			
				echo "<p><strong>>> Player 2</strong>'s Turn!</p>";
				echo "<p><strong>>></strong> Guess: $Attempt</p>";
				echo "<p><strong>>> Player 2</strong> Guessed Letter: $GuessedLetter</p>";
			
				if (strpos($CorrectWord, $GuessedLetter) !==false) {
					echo "<p>Correct Guess</p>";

						$LetterIndex = (strpos((implode('', $CorrectWordArray)), $GuessedLetter));
						$GuessedWord[$LetterIndex] = $GuessedLetter;
						echo "<p>Letter Index: $LetterIndex</p>";
					
						if ((strrpos((implode('', $CorrectWordArray)), $GuessedLetter)) != $LetterIndex) {
							$LetterIndex = (strrpos((implode('', $CorrectWordArray)), $GuessedLetter));
							$GuessedWord[$LetterIndex] = $GuessedLetter;
						} 
				} else {
							$IncorrectGuess++;
							echo "<p>Incorrect Guess: $IncorrectGuess</p>";
				}
			
				if ($IncorrectGuess <=9) {
					echo "<img src='$IncorrectGuess.png'/>";
				}
				echo "</br></br>";
				echo implode(' ', $GuessedWord);
				echo "</br></br></br>";
				echo "<p>Guessed Letters: ";
				echo implode(' ', $GuessedLetters);
				echo "</p>";
				echo "<p>------------------------</p>";
				echo "</br>";
				$Attempt++;
			}
		} while ($IncorrectGuess < 9 && strcmp(  (implode('', $GuessedWord)), $CorrectWord) );
		
		if ($IncorrectGuess >= 9) {
			$Lev = levenshtein($CorrectWord, implode($GuessedWord));
			echo "<img src='9.png'/>";
			echo "</br></br>";
			echo "<p>Sorry! Sergei has put on his hat and you lose!";
			if ($Lev <= 1) {
				echo "<p>You needed to guess 1 more letter correctly!</p>";
				echo "<p>The correct word was $CorrectWord.</p>";
			} else {
				echo "<p>You needed to guess $Lev more letters correctly!</p>";
				echo "<p>The correct word was $CorrectWord.</p>";
			}
			
		} 
		
		if ((strcmp((implode('', $GuessedWord)), $CorrectWord)) == 0) {
			if ($Attempt % 2 == 0) {
				echo "<p>Player 1 defeated Sergei in $Attempt turns!!! Sergei has disappeared in a puff of smoke!</p>";
			} else {
				echo "<p>Player 2 defeated Sergei in $Attempt turns!!! Sergei has disappeared in a puff of smoke!</p>";
			}
			
			echo "<img src='10.png'/>";
		}
		
	}
	
// FUNCTION: MAIN GAME ----------

		function Game() {
			
			global $CorrectWord, $GameNumber, $GuessedLetter, $GuessedLetters, $GuessedWord;
			
			echo "</br></br>";
			echo "<p>------------------------------------------------</p>";
			echo "<p><strong>>></strong> Welcome to the SERGEI THE SNOWMAN game.</p> <p><strong>>></strong> Try to guess the word before Sergei puts on his hat.</p>";
			echo "<p><strong>>></strong> Executing Game #$GameNumber.";
			echo "</br></br>";
			echo "<p>------------------------------------------------</p>";
			echo "</br></br>";
				
			Structure();
			$GameNumber++;
		}

// MAIN GAME ----------------------------

	do  {
		for ($i = 1; $i <= (strlen($CorrectWord)); $i++) {
			$GuessedWord[] = "_";
		}
		Game();
		$GuessedLetters = array();
		$CorrectWord = ($CorrectWords[array_rand($CorrectWords, 1)]);
		$CorrectWordArray = str_split($CorrectWord);
		$PlayCount++;
		$GuessedWord = array();
	} while ($PlayCount <= $WordCount)
		
	
// END ----------------------------------

	
?>