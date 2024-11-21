<?php

/**
 * Class JourneyAPI
 *
 * Provides functionality to sort and describe a journey based on boarding cards.
 */
class JourneyAPI {
    /**
     * Sorts the journey cards and returns the journey description.
     *
     * @param array $cards Array of BoardingCard objects.
     * @return array Sorted journey description.
     * @throws InvalidArgumentException If there are missing cards to complete the journey.
     */
    public static function getSortedJourney($cards) {
        if (empty($cards)) {
            throw new InvalidArgumentException("No boarding cards provided.");
        }

        $sortedCards = JourneySorter::sortJourney($cards);
        $journeyDescription = [];

        foreach ($sortedCards as $card) {
            $seatInfo = $card->seat ? "Sit in seat {$card->seat}." : "";
            $details = $card->details ? " {$card->details}" : "";

            if (empty($seatInfo) && strpos($details, "No seat assignment.") === false) {
                $seatInfo = "No seat assignment.";
            }

            if (strpos($card->transportation, 'flight') !== false) {
                $journeyDescription[] = "From {$card->from}, take {$card->transportation} to {$card->to}. {$seatInfo}{$details}";
            } elseif (strpos($card->transportation, 'airport bus') !== false) {
                $journeyDescription[] = "Take the {$card->transportation} from {$card->from} to {$card->to}.{$seatInfo}{$details}";
            } else {
                $journeyDescription[] = "Take {$card->transportation} from {$card->from} to {$card->to}. {$seatInfo}{$details}";
            }
        }

        $journeyDescription[] = "You have arrived at your final destination.";
        return $journeyDescription;
    }
}