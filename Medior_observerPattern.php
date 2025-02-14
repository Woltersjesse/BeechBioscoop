<?php

interface NotificationObserver
{
    public function notify($movie);
}
class UserNotification implements NotificationObserver
{
    private $user;
    public function __construct($user)
    {
        $this->user = $user;
    }




    public function notify($movie)
    {
        // Controleer of de film begint binnen 24 uur 
        $timeLeft = strtotime($movie->getStartTime()) - time();
        if ($timeLeft <= 24 * 60 * 60 && $timeLeft > 0) {
            // Verzenden van e-mail of sms 
            if ($this->user->getEmail()) {
                $this->sendEmail($this->user->getEmail(), $movie);
            }
            if ($this->user->getPhone()) {
                $this->sendSMS($this->user->getPhone(), $movie);
            }
        }
    }
    private function sendEmail($email, $movie)
    {
        mail($email, "Je film begint over 24 uur!", "Herinnering: je 
film '{$movie->getTitle()}' begint over 24 uur.");
    }

    private function sendSMS($phone, $movie)
    {
        // Stel je voor dat je een SMS API hebt om te sturen 
        echo "SMS gestuurd naar {$phone}: Je film '{$movie->getTitle()}' 
begint over 24 uur.\n";
    }
}





class Movie
{
    private $title;
    private $startTime;
    private $users = [];
    public function __construct($title, $startTime)
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
// Simuleer de tijd 24 uur voor de film 
echo "Notificaties sturen...\n";
$movie->notifyUsers();
// Verwijder de gebruikers nadat de notificatie is verstuurd 
$movie->removeObservers();
?>