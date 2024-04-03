<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="calculator">
            <form method="post">
                <div class="display">
                    <input type="text" name="display" value="<?php echo isset($_POST['display']) ? htmlspecialchars($_POST['display']) : '' ?>">
                </div>
                <div>
                    <input type="button" name="clear" value="AC" class="ecycler" onclick="clearDisplay()">
                    <input type="button" name="delete" value="DE" onclick="deleteLastChar()">
                    <input type="button" name="operator" value="/" onclick="appendToDisplay('/')">
                </div>
                <div>
                    <input type="button" name="number" value="7" onclick="appendToDisplay('7')">
                    <input type="button" name="number" value="8" onclick="appendToDisplay('8')">
                    <input type="button" name="number" value="9" onclick="appendToDisplay('9')">
                    <input type="button" name="operator" value="*" onclick="appendToDisplay('*')" class="tions">
                </div>
                <div>
                    <input type="button" name="number" value="4" onclick="appendToDisplay('4')">
                    <input type="button" name="number" value="5" onclick="appendToDisplay('5')">
                    <input type="button" name="number" value="6" onclick="appendToDisplay('6')">
                    <input type="button" name="operator" value="-" onclick="appendToDisplay('-')" class="tions">
                </div>
                <div>
                    <input type="button" name="number" value="1" onclick="appendToDisplay('1')">
                    <input type="button" name="number" value="2" onclick="appendToDisplay('2')">
                    <input type="button" name="number" value="3" onclick="appendToDisplay('3')">
                    <input type="button" name="operator" value="+" onclick="appendToDisplay('+')" class="tions">
                </div>
                <div>
                    <input type="button" name="number" value="00" onclick="appendToDisplay('00')">
                    <input type="button" name="number" value="0" onclick="appendToDisplay('0')">
                    <input type="button" name="dot" value="." onclick="appendToDisplay('.')">
                    <input type="button" name="calculate" value="=" onclick="evaluateExpression()" class="equal">
                </div>
            </form>
        </div>
    </div>

    <script>
        function appendToDisplay(value) {
            document.getElementsByName('display')[0].value += value;
        }

        function clearDisplay() {
            document.getElementsByName('display')[0].value = '';
        }

        function deleteLastChar() {
            var currentValue = document.getElementsByName('display')[0].value;
            document.getElementsByName('display')[0].value = currentValue.slice(0, -1);
        }

        function evaluateExpression() {
    var expression = document.getElementsByName('display')[0].value;

    // Check if the expression is empty or ends with an operator
    if (!expression || /[+\-*/]$/.test(expression)) {
        document.getElementsByName('display')[0].value = 'ERROR';
        return;
    }

    // Check if the expression contains only numbers without any operators
    if (/^\d*\.?\d*$/.test(expression)) {
        document.getElementsByName('display')[0].value = 'ERROR';
        return;
    }

    try {
        var result = eval(expression);
        document.getElementsByName('display')[0].value = result;
    } catch (error) {
        document.getElementsByName('display')[0].value = 'ERROR';
    }
}


    </script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['clear'])) {
        $_POST['display'] = '';
    } elseif (isset($_POST['delete'])) {
        $_POST['display'] = substr($_POST['display'], 0, -1);
    } elseif (isset($_POST['number'])) {
        $_POST['display'] .= $_POST['number'];
    } elseif (isset($_POST['operator'])) {
        $_POST['display'] .= $_POST['operator'];
    } elseif (isset($_POST['decimal'])) {
        $_POST['display'] .= $_POST['decimal'];
    } elseif (isset($_POST['calculate'])) {
        try {
            $result = eval('return ' . $_POST['display'] . ';');
            $_POST['display'] = $result;
        } catch (Exception $e) {
            $_POST['display'] = 'ERROR';
        }
    }
}
?>
    
</body>
</html>
