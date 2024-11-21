<?php

/**
 * Example usage of the JourneyAPI class.
 *
 * This script demonstrates how to use the JourneyAPI class to sort and describe
 * a journey based on a set of boarding cards.
 */
require_once __DIR__ . '/../vendor/autoload.php';


// Create an array of BoardingCard objects representing the journey segments
$cards = [
    new BoardingCard("Madrid", "Barcelona", "train 78A", "45B", ""),
    new BoardingCard("Barcelona", "Gerona Airport", "airport bus", "", "No seat assignment."),
    new BoardingCard("Gerona Airport", "Stockholm", "flight SK455", "3A", "Gate 45B. Baggage drop at ticket counter 344."),
    new BoardingCard("Stockholm", "New York JFK", "flight SK22", "7B", "Gate 22. Baggage will be automatically transferred from your last leg.")
];

// Get the sorted journey description
$sortedJourney = JourneyAPI::getSortedJourney($cards);

// Print each step of the sorted journey
foreach ($sortedJourney as $step) {
    echo $step . PHP_EOL;
    echo "<br>";
}
