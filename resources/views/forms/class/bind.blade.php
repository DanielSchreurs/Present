{!!  Html::linkAction('Www\FileController@getCSVExemple','Télécharger un fichier (.CSV) d’exemple') !!}
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="name" class="floating-placeholder__label">Le nom de la classe @include('forms.partials.required')</label>
    {!! Form::input('text','name',old('name'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : 2F']) !!}
    @include('errors.error_field',['field'=>'name','name'=>'le nom de la classe'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    {!! Form::label('student_id','Vos elèves',['for'=>'student_id']) !!}
    {!! Form::file('student_id',['class'=>'floating-placeholder__input--huge floating-placeholder__input','multiple','id'=>'student_id']) !!}
    @include('errors.error_field',['field'=>'student_id','name'=>'vos elèves'])
</div>
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn']) !!}
</div>