<?php

// Customer Class
class Customer
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

// Seat Class
class Seat
{
    public $reserved = false;

    public function reserve()
    {
        $this->reserved = true;
    }

    public function cancelReservation()
    {
        $this->reserved = false;
    }
}

// Command Interface
interface Command
{
    public function execute();
}

// ReserveTicketCommand
class ReserveTicketCommand implements Command
{
    private $seat;
    private $customer;

    public function __construct($seat, $customer)
    {
        $this->seat = $seat;
        $this->customer = $customer;
    }

    public function execute()
    {
        $this->seat->reserve();
        echo "Reservation made for " . $this->customer->name . "\n";
    }
}

// CancelReservationCommand
class CancelReservationCommand implements Command
{
    private $seat;
    private $customer;

    public function __construct($seat, $customer)
    {
        $this->seat = $seat;
        $this->customer = $customer;
    }

    public function execute()
    {
        $this->seat->cancelReservation();
        echo "Reservation canceled for " . $this->customer->name . "\n";
    }
}

// ChangeReservationCommand
class ChangeReservationCommand implements Command
{
    private $oldSeat;
    private $newSeat;
    private $customer;

    public function __construct($oldSeat, $newSeat, $customer)
    {
        $this->oldSeat = $oldSeat;
        $this->newSeat = $newSeat;
        $this->customer = $customer;
    }

    public function execute()
    {
        $this->oldSeat->cancelReservation();
        $this->newSeat->reserve();
        echo "Reservation changed for " . $this->customer->name . "\n";
    }
}

// ReservationSystem Class
class ReservationSystem
{
    public function issueCommand(Command $command)
    {
        $command->execute();
    }
}

// Create instances
$customer1 = new Customer('Alice');
$customer2 = new Customer('Bob');
$seat1 = new Seat();
$seat2 = new Seat();
$reservationSystem = new ReservationSystem();

// Reserve a seat for Alice
$reserveAlice = new ReserveTicketCommand($seat1, $customer1);
$reservationSystem->issueCommand($reserveAlice);

// Cancel Alice's reservation
$cancelAlice = new CancelReservationCommand($seat1, $customer1);
$reservationSystem->issueCommand($cancelAlice);

// Change Bob's reservation (reserve a new seat)
$reserveBob = new ReserveTicketCommand($seat2, $customer2);
$reservationSystem->issueCommand($reserveBob);

// Change Bob's seat (reserve a new seat, cancel the old one)
$changeReservation = new ChangeReservationCommand($seat1, $seat2, $customer2);
$reservationSystem->issueCommand($changeReservation);

?>