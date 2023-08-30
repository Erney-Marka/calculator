<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="mb-3">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label class="form-label" for="operators">Number One</label>
            <input type="number" class="form-control" name="num01" placeholder="enter the first number">

            <label class="form-label" for="operators">Operator</label>
            <select name="operator" class="form-select">
                <option value="addition">+</option>
                <option value="subtraction">-</option>
                <option value="multiplication">*</option>
                <option value="division">/</option>
            </select>

            <label class="form-label" for="operators">Number Two</label>
            <input type="number" class="form-control" name="num02" placeholder="enter the second number">
            <button type="" class="btn btn-success">Calculate</button>
        </form>
    </div>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstNumber = filter_input(INPUT_POST, 'num01', FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST['operator']);
        $secondNumber = filter_input(INPUT_POST, 'num02', FILTER_SANITIZE_NUMBER_FLOAT);

        // обработчик ошибок
        $errors = false;
        
        if (empty($firstNumber) || empty($secondNumber) || empty($operator)) {
            echo "<p class='calc_error'>Fill in all fields!</p>";
            $errors = true;
        }

        if (!is_numeric($firstNumber) || !is_numeric($secondNumber)) {
            echo "<p class='calc_error'>Only write numbers!</p>";
            $errors = true;
        }

        // если ошибок нет
        if (!$errors) {
            $value = 0;
            switch ($operator) {
                case 'addition':
                    $value = $firstNumber + $secondNumber;
                    break;

                case 'subtraction':
                    $value = $firstNumber - $secondNumber;
                    break;

                case 'multiplication':
                    $value = $firstNumber * $secondNumber;
                    break;

                case 'division':
                    $value = $firstNumber / $secondNumber;
                    break;

                default:
                    echo "<p class='calc_error'>Something went wrong!</p>";
            }

            echo "<p class='calc_result'>Result = {$value}</p>";
        }
    }
    ?>

</body>

</html>