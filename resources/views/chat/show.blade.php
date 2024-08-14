@extends('main')

@push('styles')
    <style>
        #users > li {
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid mt-2">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Chat') }}</div>
                <!-- Thêm khu vực hiển thị số tin nhắn chưa đọc -->
                

                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-12 border rounded-lg p-3">
                                    <ul id="messages" class="list-unstyled overflow-auto" style="min-height:45vh">
                                        @foreach ($danhsach as $mess)
                                            @if ($mess->adminid == auth()->id())                                       
                                                <li class="text-end">
                                                    <span class="list-group-item border rounded mb-2 text-end px-2 bg-primary text-white" style="display: inline-block;">
                                                         {{$mess->message}}
                                                    </span>
                                                </li>
                                            @else
                                            <li class="">
                                                <span class="list-group-item border rounded mb-2 text-end px-2 bg-light" style="display: inline-block;">
                                                    <b>{{$mess->name}}</b> {{$mess->message}}
                                                </span>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <form>
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <input type="text" required name="" id="message" class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button id="send" type="submit" class="btn btn-primary w-100">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-2">
                            <p><strong>User Online</strong></p>
                            <ul id="users" class="list-unstyled overflow-auto text-info" style="min-height:45vh">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<ul id ="testchat">
    <li>CHat</li>
</ul>
@endsection

@push('scripts')
    <script type="module">
        const userElement = document.getElementById('users');
        const messagesElement = document.getElementById('messages');
        // const messagealertsend = document.getElementById('messagealertsend');
        // Hàm cuộn xuống cuối
        function scrollToBottom() {
            messagesElement.scrollTop = messagesElement.scrollHeight;
        }

        Echo.join('chat')
            .here((users) => {
                users.forEach((user, index) =>{
                    const element = document.createElement('li');
                    element.setAttribute('id', user.id)
                    element.setAttribute('onclick', `greetUser("${user.id}")`)
                    element.innerText = user.name;

                    userElement.appendChild(element);
                })
            })
            .joining((user) => {
                const element = document.createElement('li');
                element.setAttribute('id', user.id)
                element.setAttribute('onclick', `greetUser("${user.id}")`)
                element.innerText = user.name;

                userElement.appendChild(element);
            })
            .leaving((user) => {
                const element = document.getElementById(user.id);
                element.parentNode.removeChild(element);
            })
            .listen('MessageSend', (e) =>{
                console.log({{ auth()->id() }});

                const element = document.createElement('li');
                // Tạo phần tử <span> để chứa nội dung tin nhắn
                const spanelement = document.createElement('span');

                // const divelement = document.createElement('div');

                // Thêm <span> vào trong <li>
                // element.appendChild(spanelement);

                // spanelement.innerHTML = '<b>' + e.user.name + ':</b> '  + e.message;

                // Áp dụng các lớp Bootstrap cho <li>
                spanelement.classList.add('list-group-item', 'border', 'rounded', 'mb-2','px-2', 'max-width-60');
                spanelement.style.display = 'inline-block';
                // spanelement.style.cssText = 'max-width: 60%;';
                // element.classList.add('text-end');
                
                const currentUserId = {{ auth()->id() }}; // lấy id hiện tại ucar người dùng
                if (e.user.id === currentUserId) {
                    spanelement.innerHTML = e.message;
                    spanelement.classList.add('bg-primary', 'text-white'); // Màu nền xanh, chữ trắng và đẩy sang phải
                    element.classList.add('text-end');
                    element.appendChild(spanelement);
                    // scrollToBottom(); // Cuộn xuống cuối
                } else {
                    spanelement.innerHTML = '<b>' + e.user.name + ':</b> '  + e.message;
                    spanelement.classList.add('bg-light'); // Màu nền nhạt cho tin nhắn của người khác
                    element.appendChild(spanelement);
                    // scrollToBottom(); // Cuộn xuống cuối
                    // hiển thị thông báo
                    
                    notificationMesssageNew(e.user.name, e.message)
                    // Sau 4 giây, xóa phần tử alert đi
                }

                messagesElement.appendChild(element);
                scrollToBottom(); // Cuộn xuống cuối
                
            })
    </script>

    <script type="module">
        const messElement = document.getElementById('message')
        const sendElement = document.getElementById('send')

        sendElement.addEventListener('click', (e) =>{
            e.preventDefault();
            console.log(messElement.value);
            window.axios.post('/chat/message', {
                message: messElement.value
            })

            // window.axios.post('/chat/message/send', {
            //     message: messElement.value
            // })

            messElement.value = ""
        });

    </script>

    {{-- greeting chat --}}
    <script>
        function greetUser(id){
            window.axios.post('/chat/greet/'+id);
        }
    </script>

    <script type="module">

        const messagesElement = document.getElementById('testchat')
        console.log('chat.greet.{{auth()->user()->id}}')
        Echo.private('chat.greet.{{auth()->user()->id}}')
            .listen('GreetingSent', (e) => {
                const element = document.createElement('li')
                element.innerText = e.message
                element.classList.add('text-success')

                messagesElement.appendChild(element)
            })
    </script>
@endpush

<!-- Đoạn mã jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Cuộn xuống cuối khi trang web được tải
        $('#messages').scrollTop($('#messages')[0].scrollHeight);

        // Cuộn xuống cuối khi thêm tin nhắn mới
        function scrollToBottom() {
            $('#messages').scrollTop($('#messages')[0].scrollHeight);
        }

        // Gọi hàm scrollToBottom() mỗi khi thêm tin nhắn mới vào
        // Ví dụ: sau khi broadcast tin nhắn mới từ Laravel Echo
        Echo.channel('chat')
            .listen('MessageSend', function(data) {
                // Thêm tin nhắn vào danh sách
                const element = document.createElement('li');
                element.innerHTML = '<b>' + data.user.name + ':</b> '  + data.message;
                element.classList.add('list-group-item', 'bg-light', 'border', 'rounded', 'mb-2', 'text-end');
                $('#messages').append(element);

                // Cuộn xuống cuối
                scrollToBottom();
            });

        // Hàm scrollToBottom() cũng có thể được gọi trong các sự kiện khác khi cần thiết
        // Ví dụ: khi người dùng gửi tin nhắn mới, sử dụng AJAX và sau khi phản hồi thành công
        $('#sendButton').click(function() {
            // Xử lý gửi tin nhắn bằng AJAX
            $.ajax({
                url: '/chat/message/send',
                method: 'POST',
                data: {
                    message: $('#message').val()
                },
                success: function(response) {
                    // Xử lý phản hồi thành công
                    $('#message').val(''); // Xóa nội dung tin nhắn sau khi gửi
                    scrollToBottom(); // Cuộn xuống cuối
                }
            });
        });
    });
</script>


