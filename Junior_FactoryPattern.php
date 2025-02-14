<?php

abstract class Chair
{
    protected bool $reserved = false;

    abstract public function getType(): string;

    public function reserve(): bool
    {
        if ($this->reserved) {
            echo 'This ' . $this->getType() . ' is already reserved.' . PHP_EOL;
            return false;
        } else {
            $this->reserved = true;
            echo $this->getType() . ' reserved.' . PHP_EOL;
            return true;
        }
    }
}

// Concrete Chair Classes
class NormalChair extends Chair
{
    public function getType(): string
    {
        return 'Normal Chair';
    }
}

class LuxuryChair extends Chair
{
    public function getType(): string
    {
        return 'Luxury Chair';
    }
}

class WheelchairChair extends Chair
{
    public function getType(): string
    {
        return 'Wheelchair Accessible Seat';
    }
}


// Custom Exception for Invalid Chair Type
class InvalidChairTypeException extends Exception
{
}

// Chair Factory
class ChairFactory
{
    public static function createChair(string $type): Chair
    {
        switch ($type) {
            case 'normal':
                return new NormalChair();
            case 'luxury':
                return new LuxuryChair();
            case 'wheelchair':
                return new WheelchairChair();
            default:
                throw new InvalidChairTypeException('Invalid chair type: ' . $type);
        }
    }
}

// Cinema Reservation System
class Cinema
{
    private array $chairs = [];

    public function __construct(array $chairTypes)
    {
        foreach ($chairTypes as $type) {
            $this->chairs[] = ChairFactory::createChair($type);
        }
    }

    public function reserveChair(int $index): void
    {
        if ($index >= 0 && $index < count($this->chairs)) {
            $chair = $this->chairs[$index];
            echo "Attempting to reserve: " . $chair->getType() . PHP_EOL;
            $chair->reserve();
        } else {
            echo 'Invalid chair index.' . PHP_EOL;
        }
    }

    public function showAvailableChairs(): void
    {
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
?>