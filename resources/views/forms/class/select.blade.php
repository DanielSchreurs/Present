@unless(empty($class->toArray()))
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge form-group--select">
    {!! Form::label('classes_id','Le nom des classes',['class'=>'floating-placeholder__label']) !!}
    {!! Form::select('classes_id[]',$class,old('classes_id'),['class'=>'chosen-select floating-placeholder__input--huge floating-placeholder__input','multiple']) !!}
    @include('errors.error_field',['field'=>'classes_id','name'=>'le nom des classes'])
</div>
@endunless
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn']) !!}
</div>
