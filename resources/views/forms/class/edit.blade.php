<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="edit-classe-{!! $classe->name !!}" class="floating-placeholder__label">Le nom de la classe @include('forms.partials.required')</label>
    {!! Form::input('text','name',null,['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : 2F','id'=>'edit-classe-'.$classe->name]) !!}
    @include('errors.error_field',['field'=>'name','name'=>'le nom de la classe'])
</div>
<fieldset class="form-group-container">
    <legend> Ajouter des élèves à la classe</legend>
    @if(empty($students->toArray()))
        @include('forms.partials.base-info--important',['message'=>'Si vous n’avez pas de fichier .CSV, vous pouvez '.Html::linkAction('Www\StudentController@create','créer vos élèves !')])
    @endif
    <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge add_student_to_class visuallyhidden--palm">
        {!!  Html::linkAction('Www\FileController@getCSVExemple','Télécharger un fichier (.CSV) d’exemple') !!}
        <label for="student_list" class="floating-placeholder__label">Sélectionnez le fichier (.CSV) contenant vos élèves</label>
        {!! Form::input('file','student_list',old('student_list'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','id'=>'student_list']) !!}
        @include('errors.error_field',['field'=>'student_list','name'=>'sélectionnez le fichier (.CSV) contenant vos élèves'])
    </div>
    @if(!empty($students->toArray()))
        <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge form-group--select">
            <label for="{{$classe->name}}" class="floating-placeholder__label">Sélectionnez vos élèves</label>
            {!! Form::select('students_id[]',$students,$selected_student,['class'=>'chosen-select floating-placeholder__input--huge floating-placeholder__input','multiple','id'=>'s']) !!}
            @include('errors.error_field',['field'=>'students_id','name'=>'sélectionnez vos élèves'])
        </div>
    @endif
    @if(!empty($schools->toArray()))
        <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge form-group--select">
            {!! Form::label('schools_id','Le nom des écoles',['class'=>'floating-placeholder__label']) !!}
            {!! Form::select('schools_id[]',$schools,old('schools_id'),['class'=>'chosen-select floating-placeholder__input--huge floating-placeholder__input','multiple','id'=>'schools_id']) !!}
            @include('errors.error_field',['field'=>'schools_id','name'=>'Le nom des écoles'])
            <a href="{{ URL::action('Www\StudentController@create') }}">Ou créez un élève</a>
        </div>
    @endif
</fieldset>
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn']) !!}
</div>

