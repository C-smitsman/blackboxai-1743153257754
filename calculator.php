<?php
$result = '';
$input = '';
$operation = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['number'])) {
        $input .= $_POST['number'];
    } elseif (isset($_POST['operation'])) {
        if ($input !== '') {
            if ($operation !== '' && $result !== '') {
                // Perform calculation if there's a pending operation
                switch ($operation) {
                    case '+': $result += $input; break;
                    case '-': $result -= $input; break;
                    case '*': $result *= $input; break;
                    case '/': $result /= $input; break;
                }
            } else {
                $result = $input;
            }
            $operation = $_POST['operation'];
            $input = '';
        }
    } elseif (isset($_POST['equals'])) {
        if ($input !== '' && $operation !== '') {
            switch ($operation) {
                case '+': $result += $input; break;
                case '-': $result -= $input; break;
                case '*': $result *= $input; break;
                case '/': $result /= $input; break;
            }
            $input = (string)$result;
            $operation = '';
        }
    } elseif (isset($_POST['clear'])) {
        $result = '';
        $input = '';
        $operation = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .calculator {
            width: 320px;
            background: #f3f4f6;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .btn {
            transition: all 0.2s;
        }
        .btn:active {
            transform: scale(0.95);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="calculator">
        <!-- Display -->
        <div class="bg-white p-4 text-right">
            <div class="text-gray-500 text-sm h-6">
                <?= $operation ? htmlspecialchars($result . $operation) : '&nbsp;' ?>
            </div>
            <div class="text-3xl font-semibold h-10">
                <?= htmlspecialchars($input !== '' ? $input : ($result !== '' ? $result : '0')) ?>
            </div>
        </div>

        <!-- Keypad -->
        <form method="post" class="grid grid-cols-4 gap-1 p-2">
            <!-- Row 1 -->
            <button type="submit" name="clear" class="btn bg-red-500 text-white p-4 rounded-lg font-bold">C</button>
            <button type="button" class="btn bg-gray-200 p-4 rounded-lg"></button>
            <button type="button" class="btn bg-gray-200 p-4 rounded-lg"></button>
            <button type="submit" name="operation" value="/" class="btn bg-blue-500 text-white p-4 rounded-lg font-bold">÷</button>

            <!-- Row 2 -->
            <button type="submit" name="number" value="7" class="btn bg-gray-200 p-4 rounded-lg font-bold">7</button>
            <button type="submit" name="number" value="8" class="btn bg-gray-200 p-4 rounded-lg font-bold">8</button>
            <button type="submit" name="number" value="9" class="btn bg-gray-200 p-4 rounded-lg font-bold">9</button>
            <button type="submit" name="operation" value="*" class="btn bg-blue-500 text-white p-4 rounded-lg font-bold">×</button>

            <!-- Row 3 -->
            <button type="submit" name="number" value="4" class="btn bg-gray-200 p-4 rounded-lg font-bold">4</button>
            <button type="submit" name="number" value="5" class="btn bg-gray-200 p-4 rounded-lg font-bold">5</button>
            <button type="submit" name="number" value="6" class="btn bg-gray-200 p-4 rounded-lg font-bold">6</button>
            <button type="submit" name="operation" value="-" class="btn bg-blue-500 text-white p-4 rounded-lg font-bold">-</button>

            <!-- Row 4 -->
            <button type="submit" name="number" value="1" class="btn bg-gray-200 p-4 rounded-lg font-bold">1</button>
            <button type="submit" name="number" value="2" class="btn bg-gray-200 p-4 rounded-lg font-bold">2</button>
            <button type="submit" name="number" value="3" class="btn bg-gray-200 p-4 rounded-lg font-bold">3</button>
            <button type="submit" name="operation" value="+" class="btn bg-blue-500 text-white p-4 rounded-lg font-bold">+</button>

            <!-- Row 5 -->
            <button type="submit" name="number" value="0" class="btn bg-gray-200 p-4 rounded-lg font-bold col-span-2">0</button>
            <button type="submit" name="number" value="." class="btn bg-gray-200 p-4 rounded-lg font-bold">.</button>
            <button type="submit" name="equals" class="btn bg-green-500 text-white p-4 rounded-lg font-bold">=</button>
        </form>
    </div>
</body>
</html>