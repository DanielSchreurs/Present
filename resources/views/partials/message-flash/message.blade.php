@if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close hide-modal--top" data-dismiss="alert" aria-hidden="true">
            <svg class="hide-modal--top__svg svg--{{ Session::get('flash_notification.level') }}">
                <use xlink:href="#shape-close-modal"></use>
            </svg>
            <span class="visuallyhidden">fermer la fenêtre</span></button>
        {{ Session::get('flash_notification.message') }}
    </div>
@endif
@if(Session::has('flash_message'))
    <div class="message-box">
        <p>{!! Session::get('flash_message') !!}</p>
    </div>
@endif