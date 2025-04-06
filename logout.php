<?php

session_start();
session_destroy();  // sütik törlése megtörténik

header("Location: /");