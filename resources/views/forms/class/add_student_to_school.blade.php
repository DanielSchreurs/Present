@include('forms.partials.base-info--important',['message'=>'Ici Vous pouvez ajouter des élèves à la classe, '.$classe->name.'. Il suffit d’entrer le nom des élèves.'])
@unless(empty($students->toArray()))
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge form-group--select">
    <label for="students_id" class="floating-placeholder__label">Sélectionnez vos élèves @include('forms.partials.required')</label>
    {!! Form::select('students_id[]',$students,$selected_student,['class'=>'chosen-select floating-placeholder__input--huge floating-placeholder__input','multiple','id'=>'students_id']) !!}
    @include('errors.error_field',['field'=>'students_id','name'=>'sélectionnez vos élèves'])
</div>
@endunless
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn']) !!}
</div>