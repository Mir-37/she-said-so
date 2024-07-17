<?php

if (!function_exists('generateUniqueId')) {
    function generateUniqueId(int $length = 8): string
    {
        return bin2hex(random_bytes($length / 2));
    }
}
