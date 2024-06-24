Summary

HTML File (index.html):

*Contains a text input and a button.
*Includes jQuery to handle the AJAX request.
\*Sends the entered name to the server and displays the response.

PHP File (process.php):

*Receives the AJAX request.
*Processes the input and returns a response.

/_How It Works_/
The user enters their name in the text input field and clicks the "Submit" button.
jQuery captures the button click event and sends an AJAX POST request to process.php, passing the entered name as data.
The process.php script processes the request, generates a response (e.g., "Hello, [name]!"), and sends it back to the browser.
jQuery receives the response and updates the HTML content inside the <div id="response"></div> element with the response text.
This example demonstrates the basic principles of AJAX using jQuery and PHP.
