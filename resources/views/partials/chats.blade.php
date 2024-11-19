<div class="flex flex-col min-h-screen bg-gradient-to-br from-[#E6F0FF] to-[#CCE2FF]">
    <header class="flex items-center justify-between bg-[#001839] text-white rounded-t-lg p-3">
        <h2 class="text-lg font-semibold">Chats</h2>
    </header>

    <div class="flex flex-col flex-grow overflow-y-auto p-2 space-y-4">
        @php
            $chats = [
                [
                    'id' => 1,
                    'name' => 'Carlos',
                    'avatar' => asset('storage/assets/avatar.png'),
                    'message' => 'Hola! ¿Cómo estás?'
                ],
                [
                    'id' => 2,
                    'name' => 'Ana',
                    'avatar' => asset('storage/assets/avatar.png'),
                    'message' => '¿Qué tal?'
                ]
                // Add more chats as needed
            ];
        @endphp

        @foreach($chats as $chat)
            <div 
                onclick="openChat({{ $chat['id'] }})"
                class="flex items-center gap-4 p-3 bg-white rounded-lg shadow hover:shadow-md transition border-l-4 border-[#CCE2FF] cursor-pointer"
            >
                <img
                    src="{{ $chat['avatar'] }}"
                    alt="Profile"
                    class="w-12 h-12 rounded-full object-cover"
                />
                <div class="flex flex-col">
                    <span class="font-semibold text-[#001839]">{{ $chat['name'] }}</span>
                    <p class="text-sm text-gray-600">{{ $chat['message'] }}</p>
                </div>
                <span class="ml-auto text-xs text-gray-400">3 min</span>
            </div>
        @endforeach
    </div>
</div>

<script>
function openChat(chatId) {
    // Handle chat selection - you can implement your own logic here
    console.log('Chat selected:', chatId);
}
</script>

<style>
.chats-list {
    display: flex;
    flex-direction: column;
}
.chat-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
}
</style>
