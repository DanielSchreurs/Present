<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="create-school-name" class="floating-placeholder__label">Le nom de l’école @include('forms.partials.required')</label>
    {!! Form::input('text','name',old('name'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Haute École de la Province de Liège','id'=>'create-school-name']) !!}
    @include('errors.error_field',['field'=>'name','name'=>'le nom de l’école'])
</div>
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn']) !!}
</div>
