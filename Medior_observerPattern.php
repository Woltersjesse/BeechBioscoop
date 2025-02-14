<?php

interface NotificationObserver
{
    public function notify(Movie $movie): void;
}
class UserNotification implements NotificationObserver
{
    private $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function notify(Movie $movie): void
    {
        // DateTime objects voor betere tijd
        $movieStartTime = new DateTime($movie->getStartTime());
        $currentTime = new DateTime();
        $interval = $movieStartTime->diff($currentTime);

        // Controleer of de film start in 24 uur
        if ($interval->days === 0 && $interval->h <= 24 && $interval->invert === 0) {
            if ($this->user->getEmail()) {
                $this->sendEmail($this->user->getEmail(), $movie);
            }
            if ($this->user->getPhone()) {
                $this->sendSMS($this->user->getPhone(), $movie);
            }
        }
    }
    private function sendEmail(string $email, Movie $movie): void
    {
        // Placeholder email service
        echo "Email sent to {$email}: Your movie '{$movie->getTitle()}' starts in 24 hours.\n";
    }

    private function sendSMS(string $phone, Movie $movie): void
    {
        // Placeholder sms service
        echo "SMS sent to {$phone}: Your movie '{$movie->getTitle()}' starts in 24 hours.\n";
    }
}

class Movie
{
    private $title;
    private $startTime;
    private $users = [];
    public function __construct(string $title, string $startTime)
    {
        $this->title = $title;
        $this->startTime = $startTime;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function addObserver(NotificationObserver $observer)
    {
        $this->users[] = $observer;
    }

    public function removeObserver(NotificationObserver $observer): void
    {
        // Verwijder specifieke gebruiker uit de lijst.
        $key = array_search($observer, $this->users, true);
        if ($key !== false) {
            unset($this->users[$key]);
        }
    }

    public function removeObservers()
    {
        $this->users = [];
    }

    public function notifyUsers()
    {
        foreach ($this->users as $user) {
            $user->notify($this);
        }
    }

}

class Reservation
{
    private $movie;
    private $user;
    public function __construct($movie, $user)
    {
        $this->movie = $movie;
        $this->user = $user;

        // Voeg de gebruiker toe als een observer voor deze film 
        $this->movie->addObserver(new UserNotification($user));
    }

}

class User
{
    private $email;
    private $phone;
    public function __construct($email, $phone = null)
    {
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }
}

// Maak een film 
$movie = new Movie("Avengers: Endgame", "2025-02-13 15:00:00");

// Maak een gebruiker 
$user1 = new User("email@example.com", "0612345678");
$user2 = new User("user2@example.com");

// Maak reserveringen voor de film 
$reservation1 = new Reservation($movie, $user1);
$reservation2 = new Reservation($movie, $user2);

echo "Removing user1 from notifications...\n";
$movie->removeObserver(new UserNotification($user1));

// Simuleer de tijd 24 uur voor de film 
echo "Notificaties sturen...\n";
$movie->notifyUsers();
// Verwijder de gebruikers nadat de notificatie is verstuurd 
$movie->removeObservers();
?>