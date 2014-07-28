<html>
    <head>
        <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".numbers-only").keydown(function(event) {
                    // Prevent shift key since its not needed
                    if (event.shiftKey == true) {
                        event.preventDefault();
                    }
                    // Allow Only: keyboard 0-9, numpad 0-9, backspace, tab, left arrow, right arrow, delete
                    if ((event.keyCode >= 48 && event.keyCode <= 57) || 
                            (event.keyCode >= 96 && event.keyCode <= 105) || 
                            event.keyCode == 8 || 
                            event.keyCode == 9 || 
                            event.keyCode == 37 || 
                            event.keyCode == 39 ||
                            event.keyCode == 46 || 
                            ($(this).data('decimal') && event.keyCode == 190 && $(this).val().indexOf('.') === -1)) {
                        // Allow normal operation
                    } else {
                        // Prevent the rest
                        event.preventDefault();
                    }
                });
            });
        </script>
    </head>
    <body>
        <input type="text" name="hello" class="numbers-only" data-decimal="true"/>
    </body>
</html>
