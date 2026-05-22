<?php

// --- Завдання 1: Видалення всіх парних чисел із масиву --
$array1 = [];
for ($i = 0; $i < 15; $i++) {
    $array1[] = rand(1, 100);
}
echo "Завдання 1. Початковий масив: " . implode(", ", $array1) . "\n";

$oddArray = [];
foreach ($array1 as $number) {
    if ($number % 2 !== 0) {
        $oddArray[] = $number;
    }
}
echo "Масив без парних чисел: " . implode(", ", $oddArray) . "\n\n";


// --- Завдання 2: Перевірка, чи масив є паліндромом ---
$input2 = "1, 2, 3, 2, 1";
$array2 = array_map('trim', explode(',', $input2));
$reversedArray2 = array_reverse($array2);

echo "Завдання 2. Введений масив: " . implode(", ", $array2) . "\n";
if ($array2 === $reversedArray2) {
    echo "Цей масив є паліндромом.\n\n";
} else {
    echo "Цей масив НЕ є паліндромом.\n\n";
}


// --- Завдання 3: Підрахунок кількості парних чисел у масиві ---
$input3 = "10, 15, 22, 33, 40";
$array3 = array_map('trim', explode(',', $input3));
$evenCount = 0;

foreach ($array3 as $num) {
    if (is_numeric($num) && $num % 2 == 0) {
        $evenCount++;
    }
}
echo "Завдання 3. Введений масив: " . implode(", ", $array3) . "\n";
echo "Кількість парних чисел: $evenCount\n\n";


// --- Завдання 4: Числа кратні 4 у діапазоні 100-200 та їх сума ---
$sum4 = 0;
$multiplesOf4 = [];

for ($i = 100; $i <= 200; $i++) {
    if ($i % 4 == 0) {
        $multiplesOf4[] = $i;
        $sum4 += $i;
    }
}
echo "Завдання 4. Сума чисел від 100 до 200, які кратні 4: $sum4\n\n";


// --- Завдання 5: Пошук другого за величиною елемента в масиві ---
$array5 = [];
for ($i = 0; $i < 10; $i++) {
    $array5[] = rand(0, 50);
}
echo "Завдання 5. Початковий масив: " . implode(", ", $array5) . "\n";

$uniqueArray5 = array_unique($array5);
rsort($uniqueArray5);

if (isset($uniqueArray5[1])) {
    echo "Друге за величиною число: " . $uniqueArray5[1] . "\n\n";
} else {
    echo "В масиві недостатньо унікальних елементів.\n\n";
}


// --- Завдання 6: Підрахунок добутку непарних чисел масиву ---
$array6 = [];
$product6 = 1;
$hasOddNumbers = false;

for ($i = 0; $i < 15; $i++) {
    $array6[] = rand(1, 100);
}
echo "Завдання 6. Масив: " . implode(", ", $array6) . "\n";

foreach ($array6 as $num) {
    if ($num % 2 !== 0) {
        $product6 *= $num;
        $hasOddNumbers = true;
    }
}

if ($hasOddNumbers) {
    echo "Добуток непарних чисел: $product6\n\n";
} else {
    echo "Непарних чисел у масиві немає.\n\n";
}


// --- Завдання 7: Перетворення дати у текстовий формат ---
$inputDate = "12.06.2025";
$months = [
    '01' => 'січня', '02' => 'лютого', '03' => 'березня', '04' => 'квітня',
    '05' => 'травня', '06' => 'червня', '07' => 'липня', '08' => 'серпня',
    '09' => 'вересня', '10' => 'жовтня', '11' => 'листопада', '12' => 'грудня'
];

list($day, $month, $year) = explode('.', $inputDate);
$textDate = (int)$day . " " . $months[$month] . " " . $year . " року";

echo "Завдання 7. Введена дата: $inputDate\n";
echo "Текстовий формат: $textDate\n\n";


// --- Завдання 8: Кількість елементів, кратних 100 у масиві ---
$array8 = [];
$count100 = 0;

for ($i = 0; $i < 20; $i++) {
    $array8[] = rand(50, 500);
}
echo "Завдання 8. Масив: " . implode(", ", $array8) . "\n";

foreach ($array8 as $num) {
    if ($num % 100 == 0) {
        $count100++;
    }
}
echo "Кількість елементів, кратних 100: $count100\n\n";


// --- Завдання 9: Числа, що діляться на 5, та їхня сума (через fmod) ---
$sum9 = 0;
$divisibleBy5 = [];

for ($i = 20; $i <= 45; $i++) {
    if (fmod($i, 5) == 0) {
        $divisibleBy5[] = $i;
        $sum9 += $i;
    }
}
echo "Завдання 9. Числа від 20 до 45, що діляться на 5: " . implode(", ", $divisibleBy5) . "\n";
echo "Сума цих чисел: $sum9\n\n";


// --- Завдання 10: Симуляція світлофора ---
$minute = 14;
echo "Завдання 10. Введена хвилина: $minute\n";

$cyclePosition = $minute % 5;

if ($cyclePosition >= 1 && $cyclePosition <= 3) {
    echo "Колір сигналу: Зелений\n";
} else {
    echo "Колір сигналу: Червоний\n";
}

?>