@include('forms.partials.base-info--important',['message'=>'Afin de supprimez votre compte, entrez le mot : <i>SUPPRIMER</i>'])
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="confirm" class="floating-placeholder__label">Tapez de toute lettre, SUPPRIMER @include('forms.partials.required')</label>
    {!! Form::input('text','confirm',null,['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : SUPPRIMER','autofocus']) !!}
    @include('errors.error_field',['field'=>'confirm','name'=>'confirmation'])
</div>
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn btn--alert']) !!}
</div>