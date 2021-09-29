<!-- Sweet Alert Message -->
@if (session()->has('message'))
    <div class="flashdata" style="display: none;">
        <div class="data-icon">{{ session('message')['icon'] }}</div>
        <div class="data-title">{{ session('message')['title'] }}</div>
        <div class="data-text">{{ session('message')['text'] }}</div>
        @if (array_key_exists('to_id', session('message')))
            <div class="data-to_id">{{ session('message')['to_id'] }}</div>
        @endif
    </div>
@endif
