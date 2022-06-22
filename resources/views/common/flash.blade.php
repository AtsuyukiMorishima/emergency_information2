<!-- フラッシュメッセージ -->
@if (session('flash_message'))
    <div id='flash' class="alert alert-success">
        {{ session('flash_message') }}
    </div>
@endif
