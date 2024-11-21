<?php

use PHPUnit\Framework\TestCase;

/**
 * Class JourneyAPITest
 *
 * This class contains unit tests for the JourneyAPI class.
 */
class JourneyAPITest extends TestCase {
    /**
     * Test that the journey is correctly sorted and described.
     */
    public function testGetSortedJourney() {
        $cards = [
            new BoardingCard("Madrid", "Barcelona", "train 78A", "45B", ""),
            new BoardingCard("Barcelona", "Gerona Airport", "airport bus", "", "No seat assignment."),
            new BoardingCard("Gerona Airport", "Stockholm", "flight SK455", "3A", "Gate 45B. Baggage drop at ticket counter 344."),
            new BoardingCard("Stockholm", "New York JFK", "flight SK22", "7B", "Gate 22. Baggage will be automatically transferred from your last leg.")
        ];

        $expectedJourney = [
            "Take train 78A from Madrid to Barcelona. Sit in seat 45B.",
            "Take the airport bus from Barcelona to Gerona Airport. No seat assignment.",
            "From Gerona Airport, take flight SK455 to Stockholm. Sit in seat 3A. Gate 45B. Baggage drop at ticket counter 344.",
            "From Stockholm, take flight SK22 to New York JFK. Sit in seat 7B. Gate 22. Baggage will be automatically transferred from your last leg.",
            "You have arrived at your final destination."
        ];

        $sortedJourney = JourneyAPI::getSortedJourney($cards);
        $this->assertEquals($expectedJourney, $sortedJourney);
    }

    /**
     * Test that the journey is correctly sorted and described when the cards are unordered.
     */
    public function testGetSortedJourneyWithUnorderedCards() {
        $cards = [
            new BoardingCard("Stockholm", "New York JFK", "flight SK22", "7B", "Gate 22. Baggage will be automatically transferred from your last leg."),
            new BoardingCard("Madrid", "Barcelona", "train 78A", "45B", ""),
            new BoardingCard("Gerona Airport", "Stockholm", "flight SK455", "3A", "Gate 45B. Baggage drop at ticket counter 344."),
            new BoardingCard("Barcelona", "Gerona Airport", "airport bus", "", "No seat assignment.")
        ];

        $expectedJourney = [
            "Take train 78A from Madrid to Barcelona. Sit in seat 45B.",
            "Take the airport bus from Barcelona to Gerona Airport. No seat assignment.",
            "From Gerona Airport, take flight SK455 to Stockholm. Sit in seat 3A. Gate 45B. Baggage drop at ticket counter 344.",
            "From Stockholm, take flight SK22 to New York JFK. Sit in seat 7B. Gate 22. Baggage will be automatically transferred from your last leg.",
            "You have arrived at your final destination."
        ];

        $sortedJourney = JourneyAPI::getSortedJourney($cards);
        $this->assertEquals($expectedJourney, $sortedJourney);
    }

    /**
     * Test that an exception is thrown when there are no cards.
     */
    public function testGetSortedJourneyWithNoCards() {
        $cards = [];

        $this->expectException(InvalidArgumentException::class);
        JourneyAPI::getSortedJourney($cards);
    }

    /**
     * Test that an exception is thrown when there are missing cards.
     */
    public function testGetSortedJourneyWithMissingCards() {
        $cards = [
            new BoardingCard("Madrid", "Barcelona", "train 78A", "45B", ""),
            new BoardingCard("Gerona Airport", "Stockholm", "flight SK455", "3A", "Gate 45B. Baggage drop at ticket counter 344.")
        ];

        $this->expectException(InvalidArgumentException::class);
        JourneyAPI::getSortedJourney($cards);
    }
}