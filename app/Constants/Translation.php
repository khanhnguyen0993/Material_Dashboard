<?php 
namespace App\Constants;

class Translation{
  // --------------- COMPETITION SECTION --------------- //
  const STATION_2CA = 1;
  const STATION_2CA_TXT = '2CA';
  const STATION_2CC = 2;
  const STATION_2CC_TXT = '2CC';

  const STATUS_CLOSED = 0;
  const STATUS_CLOSED_TXT = 'Closed';
  const STATUS_OPEN = 1;
  const STATUS_OPEN_TXT = 'Open';

  const TYPE_INSTANT_WIN = 1;
  const TYPE_INSTANT_WIN_TXT = 'Instant Win';
  const TYPE_LUCKY_DRAW = 2;
  const TYPE_LUCKY_DRAW_TXT = 'Lucky Draw';
  const TYPE_BIRTHDAY_WILL = 3;
  const TYPE_BIRTHDAY_WILL_TXT = 'Birthday Will';
  const TYPE_CASH_PRIZE = 4;
  const TYPE_CASH_PRIZE_TXT = 'Cash Prize';

  // --------------- USER / ADMIN SECTION --------------- //
  const USER_2CA = 1;
  const USER_2CA_TXT = '2CA';
  const USER_2CC = 2;
  const USER_2CC_TXT = '2CC';
  const USER_ADMIN = 3;
  const USER_ADMIN_TXT = 'Admin';

  // -------------- Listener-Prize HASWON SECTION --------------- //
  const HASWON_STATUS_AWAITING = 0;
  const HASWON_STATUS_AWAITING_TXT = 'Awaiting Collection';
  const HASWON_STATUS_COLLECTED = 1;
  const HASWON_STATUS_COLLECTED_TXT = 'Collected';
  const HASWON_STATUS_ENROLLED = 2;
  const HASWON_STATUS_ENROLLED_TXT = 'Enrolled';
  const HASWON_STATUS_NO_PRIZE = 3;
  const HASWON_STATUS_NO_PRIZE_TXT = 'No Prize';

  const HASWON_PRIZE_FREE_DRINK = 0;
  const HASWON_PRIZE_FREE_DRINK_TXT = 'A free drink';
  const HASWON_PRIZE_MOVIE_TICKETS = 1;
  const HASWON_PRIZE_MOVIE_TICKETS_TXT = 'Movie tickets';
  const HASWON_PRIZE_MIAMI_TRIP = 2;
  const HASWON_PRIZE_MIAMI_TRIP_TXT = 'A trip to Miami';

}
