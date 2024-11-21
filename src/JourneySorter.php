<?php

/**
 * Class JourneySorter
 *
 * Provides functionality to sort journey cards.
 */
class JourneySorter {
    /**
     * Sorts the journey cards.
     *
     * @param array $cards Array of BoardingCard objects.
     * @return array Sorted array of BoardingCard objects.
     * @throws InvalidArgumentException If there are missing cards to complete the journey.
     */
    public static function sortJourney($cards) {
        $fromToMap = [];
        $toFromMap = [];

        foreach ($cards as $card) {
            $fromToMap[$card->from] = $card;
            $toFromMap[$card->to] = $card;
        }

        // Find the starting point (the city that is not in the toFromMap)
        $start = null;
        foreach ($fromToMap as $from => $card) {
            if (!isset($toFromMap[$from])) {
                $start = $from;
                break;
            }
        }

        if ($start === null) {
            throw new InvalidArgumentException("Missing starting point.");
        }

        $sortedJourney = [];
        while (isset($fromToMap[$start])) {
            $card = $fromToMap[$start];
            $sortedJourney[] = $card;
            $start = $card->to;
        }

        // Check if there are any missing cards
        if (count($sortedJourney) !== count($cards)) {
            throw new InvalidArgumentException("Missing cards to complete the journey.");
        }

        return $sortedJourney;
    }
}