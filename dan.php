<!DOCTYPE html>
<html>
<head>
    <title>Simple Chat Room</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Function to send a message to the server
        function sendMessage() {
            var message = $('#message').val();
            if (message !== '') {
                $.post('chatroom.php', { text: message }, function(data) {
                    $('#message').val('');
                    $('#chat').append(data);
                });
            }
        }

        // Poll for new messages every 2 seconds
        setInterval(function() {
            $.get('chatroom.php', function(data) {
                $('#chat').html(data);
            });
        }, 2000);
    </script>
</head>
<body>
    <h1>Simple Chat Room</h1>
    <div id="chat"></div>
    <input type="text" id="message" placeholder="Type your message...">
    <button onclick="sendMessage()">Send</button>

    <?php
// Initialize or load your chat data (e.g., an array or database)

// Handle incoming messages
if (isset($_POST['text']) && !empty($_POST['text'])) {
    $message = htmlspecialchars($_POST['text']);
    
    // Store the message in your data storage or database
    // For this example, we'll just echo it back
    echo '<div><strong>You:</strong> ' . $message . '</div>';
    exit();
}

// Retrieve and display chat messages
// You should retrieve and display messages from your data storage or database here
// For this example, we'll just simulate messages
$messages = [
    '<div><strong>User1:</strong> Hello!</div>',
    '<div><strong>User2:</strong> Hi there!</div>',
    '<div><strong>User1:</strong> How are you?</div>',
];

foreach ($messages as $message) {
    echo $message;
}
?>

</body>
</html>
