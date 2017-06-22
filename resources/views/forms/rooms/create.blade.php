@if(count($schools)==1)
    <input type="hidden" name="school_id" value="{!! Auth::user()->schools[0]->id !!}">
@else
    @unless(empty($schools->toArray()))
        <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
            {!! Form::label('school_id','Le nom de l’école',['class'=>'floating-placeholder__label']) !!}
            {!! Form::select('school_id',$schools,old('school_id'),['class'=>'mask visuallyhidden',"data-type"=>"select"]) !!}
            @include('errors.error_field',['field'=>'school_id','name'=>'le nom de l’école'])
        </div>
    @endunless
@endif
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="name" class="floating-placeholder__label">Le nom du local</label>
    {!! Form::input('text','name',old('name'),['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : local d’informatique']) !!}
    @include('errors.error_field',['field'=>'name','name'=>'le nom du local'])
</div>
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit('Créer le local',['class'=>'btn']) !!}
</div>
