<?php
/**
 * Vtiger CRM for Docker
 * Copyright (c) 2018-2020 Francesco Bianco <bianco@javanile.org>
 * MIT License <https://git.io/docker-vtiger-license>
 */

/**
 * Retrieve realpath without resolve symbolic link.
 *
 * @param $path
 * @param null $link
 *
 * @return false|string
 */
function __realpath__($path, $link = null)
{
    if ($link) {
        $head = trim(substr($path, strlen($link)), '/');
        $base = basename($link);
        $real = __realpath__(dirname($link));

        return $real.'/'.$base.'/'.$head;
    }

    $link = $path;
    while (!is_link($link) && $link != '.' && $link != '/') {
        $link = dirname($link);
    }

    if ($link != '.' && $link != '/') {
        return __realpath__($path, $link);
    }

    return realpath($path);
}
