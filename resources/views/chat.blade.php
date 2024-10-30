<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Chat</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
</head>
<body>
    <div x-data="chatComponent()" class="container mx-auto p-4">
        <div class="chat-box p-4 bg-white border rounded shadow-lg">
            <div class="messages">
                <template x-for="message in messages" :key="message">
                    <div class="message p-2 my-2 bg-gray-100 rounded">
                        <p x-text="message"></p>
                    </div>
                </template>
            </div>
            <input type="text" x-model="newMessage" placeholder="Type your message..." class="p-2 w-full border rounded my-2" />
            <button @click="sendMessage()" class="bg-blue-500 text-white p-2 rounded">Send</button>
        </div>
    </div>

    <script>
        function chatComponent() {
            return {
                messages: [],
                newMessage: '',
                init() {
                    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                        encrypted: true
                    });
                    const channel = pusher.subscribe('chat');
                    channel.bind('App\\Events\\MessageSent', (data) => {
                        this.messages.push(data.message);
                    });
                },
                sendMessage() {
                    if (this.newMessage.trim() === '') return;

                    fetch('/send-message', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ message: this.newMessage })
                    }).then(() => {
                        this.newMessage = '';
                    });
                }
            }
        }
    </script>
</body>
</html>
