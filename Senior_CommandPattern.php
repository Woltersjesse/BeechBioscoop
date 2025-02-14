<?php

const customer1 = new Customer('Alice');
const customer2 = new Customer('Bob');
const seat1 = new Seat();
const seat2 = new Seat();
const reservationSystem = new ReservationSystem();
// Reserve a seat for Alice 
const reserveAlice = new ReserveTicketCommand(seat1, customer1);
reservationSystem . issueCommand(reserveAlice);
// Cancel Alice's reservation 
const cancelAlice = new CancelReservationCommand(seat1, customer1);
reservationSystem . issueCommand(cancelAlice);
// Change Bob's reservation (reserve a new seat) 
const reserveBob = new ReserveTicketCommand(seat2, customer2);
const changeReservation = new ChangeReservationCommand(
    seat1,
    seat2,
    customer2
);
reservationSystem . issueCommand(changeReservation);

?>