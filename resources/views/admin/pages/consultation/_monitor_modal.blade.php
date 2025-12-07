<div id="messageContainer" style="height:60vh; overflow-y:auto; padding:16px">
  @foreach ($messages as $msg)
    <div class="mb-3">
      <div class="small text-muted">
        {{ $msg->sender->name }} • {{ $msg->created_at->format('H:i') }}
      </div>
      <div class="bg-light rounded p-2">
        {{ $msg->body }}
      </div>
    </div>
  @endforeach
</div>

<script>
  (function() {

    const chatId = {{ $chat->id }};
    const container = document.getElementById('messageContainer');

    console.log('[ADMIN MONITOR] subscribing chats.' + chatId);

    window.Echo.private(`chats.${chatId}`)
      .listen('.new-message', e => {
        console.log('[ADMIN MONITOR] new message:', e.message);
        append(e.message);
      });

    function append(msg) {
      if (msg.type === 'system') return;

      container.insertAdjacentHTML('beforeend', `
      <div class="mb-3">
        <div class="small text-muted">
          ${msg.sender?.name ?? 'System'} •
          ${new Date(msg.created_at).toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit'
          })}
        </div>
        <div class="bg-light rounded p-2">
          ${msg.body ?? ''}
        </div>
      </div>
    `);

      container.scrollTop = container.scrollHeight;
    }

  })();
</script>
