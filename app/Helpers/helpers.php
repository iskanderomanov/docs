<?php
function shortenName($fullName)
{
    $nameParts = explode(' ', $fullName);
    $shortName = '';

    // Проверяем, что у имени есть хотя бы одна фамилия и одно имя
    if (count($nameParts) >= 2) {
        $shortName .= $nameParts[0] . ' '; // Фамилия
        $shortName .= mb_substr($nameParts[1], 0, 1) . '.'; // Первая буква имени

        // Если есть отчество, добавляем сокращенную форму
        if (count($nameParts) > 2) {
            $shortName .= mb_substr($nameParts[2], 0, 1) . '.'; // Первая буква отчества
        }
    } else {
        $shortName = $fullName; // Если имя состоит только из одной части, оставляем его без изменений
    }

    return $shortName;
}
?>
