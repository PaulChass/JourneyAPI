# JourneyAPI

JourneyAPI is a PHP library that sorts a list of boarding cards and provides a description of how to complete your journey.

## Installation

Clone the repository and install the dependencies using Composer:

```sh
git clone https://github.com/yourusername/JourneyAPI.git
cd JourneyAPI
composer install
```

## Usage

Include the necessary files and use the JourneyAPI class to get the sorted journey description:

```php
<?php
require_once 'vendor/autoload.php';

$cards = [
    new BoardingCard("Madrid", "Barcelona", "train 78A", "45B", ""),
    new BoardingCard("Barcelona", "Gerona Airport", "airport bus", "", "No seat assignment."),
    new BoardingCard("Gerona Airport", "Stockholm", "flight SK455", "3A", "Gate 45B. Baggage drop at ticket counter 344."),
    new BoardingCard("Stockholm", "New York JFK", "flight SK22", "7B", "Gate 22. Baggage will be automatically transferred from your last leg.")
];

$sortedJourney = JourneyAPI::getSortedJourney($cards);
foreach ($sortedJourney as $step) {
    echo $step . PHP_EOL;
}
```

## Running Tests

Run the tests using PHPUnit:

```sh
vendor/bin/phpunit
```

## Example

You can find an example usage in the ExampleUsage.php file: