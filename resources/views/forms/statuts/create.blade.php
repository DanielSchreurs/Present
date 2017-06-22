<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="name" class="floating-placeholder__label">Le nom du statut @include('forms.partials.required')</label>
    {!! Form::input('text','name',old('name'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Présent','id'=>'name']) !!}
    @include('forms.partials.base-info',['message'=>'Entrez un nouveau statut que vous retrouverez quand vous prendrez les présences.'])
    @include('errors.error_field',['field'=>'name','name'=>'le nom du statut'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge link-for-input-action-container">
    <label for="color" class="floating-placeholder__label">Choisissez une
        couleur @include('forms.partials.required')</label>
    {!! Form::select('color',$colorTable,old('color'),['class'=>'mask visuallyhidden color-selector',"data-type"=>"select",'id'=>"color"]) !!}
    @include('errors.error_field',['field'=>'color','name'=>'choisissez une couleur'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge link-for-input-action-container">
    {!! Form::checkbox('update_default','',old('update_default'),['class'=>'','id'=>'update_default']) !!}
    <label for="update_default" class="">En faire le statut par
        défaut (un seul possible)</label>
    @include('errors.error_field',['field'=>'update_default','name'=>'en faire le statut par défaut'])
</div>
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn btn--small']) !!}
</div>