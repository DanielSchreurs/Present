<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="create-cours-name" class="floating-placeholder__label">Le nom du cours @include('forms.partials.required')</label>
    {!! Form::input('text','name',old('name'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Français','id'=>'create-cours-name']) !!}
    @include('forms.partials.base-info',['message'=>'Il vous suffit d’entrer un nom arbitraire du cours que vous voulez créer'])
    @include('errors.error_field',['field'=>'name','name'=>'le nom du cours'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="create-cours-description" class="floating-placeholder__label">Une description du cours</label>
    {!! Form::textarea('description',old('description'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Un simple petit texte qui décrit le cours','id'=>'create-cours-description']) !!}
    @include('forms.partials.base-info',['message'=>'Vous pouvez introduire une petite description, celle-ci est optionnelle.'])
    @include('errors.error_field',['field'=>'description','name'=>'une description du cours'])
</div>
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn']) !!}
</div>
