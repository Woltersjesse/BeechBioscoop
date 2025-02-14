<?php

// Chair Interface
interface Chair {
    public function getType(): string;
    public function reserve(): void;
}

// Concrete Chair Classes
class NormalChair implements Chair {
    private $reserved = false;

    public function getType(): string {
        return 'Normal Chair';
    }

    public function reserve(): void {
        if ($this->reserved) {
            echo 'This normal chair is already reserved.' . PHP_EOL;
        } else {
            $this->reserved = true;
            echo 'Normal chair reserved.' . PHP_EOL;
        }
    }
}

class LuxuryChair implements Chair {
    private $reserved = false;

    public function getType(): string {
        return 'Luxury Chair';
    }

    public function reserve(): void {
        if ($this->reserved) {
            echo 'This luxury chair is already reserved.' . PHP_EOL;
        } else {
            $this->reserved = true;
            echo 'Luxury chair reserved.' . PHP_EOL;
        }
    }
}

class WheelchairChair implements Chair {
    private $reserved = false;

    public function getType(): string {
        return 'Wheelchair Accessible Seat';
    }

    public function reserve(): void {
        if ($this->reserved) {
            echo 'This wheelchair accessible seat is already reserved.' . PHP_EOL;
        } else {
            $this->reserved = true;
            echo 'Wheelchair accessible seat reserved.' . PHP_EOL;
        }
    }
}

// Chair Factory
class ChairFactory {
    public static function createChair(string $type): Chair {
        switch ($type) {
            case 'normal':
                return new NormalChair();
            case 'luxury':
                return new LuxuryChair();
            case 'wheelchair':
                return new WheelchairChair();
            default:
                throw new Exception('Invalid chair type');
        }
    }
}

// Cinema Reservation System
class Cinema {
    private $chairs = [];

    public function __construct(array $chairTypes) {
        // Create chairs based on the provided types
        foreach ($chairTypes as $type) {
            $this->chairs[] = ChairFactory::createChair($type);
        }
    }

    public function reserveChair(int $index): void {
        if ($index >= 0 && $index < count($this->chairs)) {
            $chair = $this->chairs[$index];
            echo "Attempting to reserve: " . $chair->getType() . PHP_EOL;
            $chair->reserve();
        } else {
            echo 'Invalid chair index.' . PHP_EOL;
        }
    }

    public function showAvailableChairs(): void {
        echo 'Available Chairs in the Cinema:' . PHP_EOL;
        foreach ($this->chairs as $index => $chair) {
            echo ($index + 1) . '. ' . $chair->getType() . PHP_EOL;
        }
    }
}

// Usage Example
$cinema = new Cinema(['normal', 'luxury', 'normal', 'wheelchair', 'luxury']);
$cinema->showAvailableChairs();

$cinema->reserveChair(0); // Reserve Normal Chair
$cinema->reserveChair(1); // Reserve Luxury Chair
$cinema->reserveChair(3); // Reserve Wheelchair Accessible Seat
$cinema->reserveChair(2); // Reserve Normal Chair
$cinema->showAvailableChairs();

?>