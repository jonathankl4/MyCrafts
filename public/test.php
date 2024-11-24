<?php
if (file_exists(__DIR__ . '/../.env')) {
    echo ".env file exists.";
} else {
    echo ".env file does not exist!";
}
