<?php

/**
 * Функция для экранирования HTML
 */
function htmlSpec($var)
{
    return htmlspecialchars($var, ENT_QUOTES);
}
