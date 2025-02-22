<?php

require __DIR__ . '/../../config/bootstrap.php';

use Core\Database\Database;
use Database\Populate\AppointmentsPopulate;
use Database\Populate\UsersPopulate;
use Database\Populate\StudiosPopulate;

Database::migrate();

UsersPopulate::populate();
AppointmentsPopulate::populate();
StudiosPopulate::populate();