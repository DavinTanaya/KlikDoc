
<div class="med-item" id="reminder-{{ $reminder->id }}">
  <div>
    <h4>{{ $reminder->name }}</h4>
    <p>{{ $reminder->frequency }}x sehari — {{ $reminder->time }} WIB</p>
    <small class="text-muted">{{ $reminder->note }}</small>
  </div>

  <button class="delete-btn" onclick="deleteReminder({{ $reminder->id }})">
    <i class="fas fa-trash"></i>
  </button>
</div>
