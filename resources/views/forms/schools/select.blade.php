@unless(empty($schools->toArray()))
    <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge form-group--select">
        <label for="schools_id" class="floating-placeholder__label">Le nom de l’école</label>
        {!! Form::select('schools_id[]',$schools,null,['class'=>'chosen-select floating-placeholder__input--huge floating-placeholder__input','multiple']) !!}
        @include('errors.error_field',['field'=>'schools_id','name'=>'le nom de l’école'])
    </div>
@endunless
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn']) !!}
</div>
