<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat</title>
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/emoji-mart@5.4.1/css/emoji-mart.css" /> --}}
    <link rel="stylesheet" href="{{url('/emojionearea/emojionearea.min.css')}}">
    {{-- <link rel="stylesheet" href="/emojionearea/emojionearea.min.css"> --}}
</head>
<body>

    <ul id="testchat"></ul>
    <br><br>
    <h5>test</h5>
    <div id="chat-container">
        <input type="text" id="message-input" placeholder="Type a message">
        <button id="emoji-button">😊😂</button>
        <div id="emoji-picker">ok</div>
        <button class="btn btn-success" id="send-button">Send</button>
    </div>

    <div class="" style="width:80%; margin-top:200px">
        <textarea class="emojionearea"></textarea>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{url('emojionearea/emojionearea.min.js')}}"></script>
    <script type="text/javascript">
          $(".emojionearea").emojioneArea();
    </script>
</body>
</html>
