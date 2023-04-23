
const reservations = [];

const reservationForm = document.getElementById('reservation-form');
const reservationMessage = document.getElementById('reservation-message');


reservationForm.addEventListener('submit', (event) => {
  event.preventDefault();

 
  const date = document.getElementById('date').value;
  const time = document.getElementById('time').value;
  const duration = document.getElementById('duration').value;

  const available = isAvailable(date, time, duration);

  if (available) {
   
    const reservation = { date, time, duration };
    reservations.push(reservation);

   
    reservationMessage.innerHTML = `Sua reserva para ${date} às ${time} foi confirmada!`;
    reservationForm.reset();
  } else {

    reservationMessage.innerHTML = `A sala não está disponível para ${date} às ${time}. Por favor, escolha outra data ou horário.`;
  }
});


function isAvailable(date, time, duration) {
  const reservationStart = new Date(`${date}T${time}`);
  const reservationEnd = new Date(reservationStart.getTime() + duration * 60 * 60 * 1000);


  for (const reservation of reservations) {
    const existingReservationStart = new Date(`${reservation.date}T${reservation.time}`);
    const existingReservationEnd = new Date(existingReservationStart.getTime() + reservation.duration * 60 * 60 * 1000);

    if (
      reservationStart < existingReservationEnd &&
      existingReservationStart < reservationEnd
    ) {
     
      return false;
    }
  }
  return true;
}
