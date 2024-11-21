<?php

/**
 * Class BoardingCard
 *
 * Represents a boarding card for a journey segment.
 */
class BoardingCard {
    public $from;
    public $to;
    public $transportation;
    public $seat;
    public $details;

    /**
     * BoardingCard constructor.
     *
     * @param string $from Starting location.
     * @param string $to Destination location.
     * @param string $transportation Means of transportation.
     * @param string $seat Seat assignment.
     * @param string $details Additional details.
     */
    public function __construct($from, $to, $transportation, $seat, $details) {
        if (empty($from) || empty($to) || empty($transportation)) {
            throw new InvalidArgumentException("From, to, and transportation cannot be empty.");
        }
        $this->from = $from;
        $this->to = $to;
        $this->transportation = $transportation;
        $this->seat = $seat;
        $this->details = $details;
    }
}