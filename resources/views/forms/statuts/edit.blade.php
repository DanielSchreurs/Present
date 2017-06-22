<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge">
    <label for="name-{{$statut->id}}" class="floating-placeholder__label">Le nom du
        statut @include('forms.partials.required')</label>
    {!! Form::input('text','name',null,['class'=>'floating-placeholder__input--huge floating-placeholder__input','placeholder'=>'ex : Présent','id'=>'name-'.$statut->id]) !!}
    @include('forms.partials.base-info',['message'=>'Entrez un nouveau statut que vous retrouverez quand vous prendrez les présences.'])
    @include('errors.error_field',['field'=>'name','name'=>'le nom du statut'])
</div>
<div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge link-for-input-action-container">
    <label for="color-{{$statut->id}}" class="floating-placeholder__label">Choisissez une
        couleur @include('forms.partials.required')</label>
    {!! Form::select('color',array_merge($colorTable,[$statut->color=>$allColor[$statut->color]]),$statut->color,['class'=>'mask color-selector',"data-type"=>"select",'id'=>"color-".$statut->id]) !!}
    @include('errors.error_field',['field'=>'color','name'=>'choisissez une couleur'])
</div>
@if(!$statut->is_default)
    <div class="floating-placeholder form-group floating-placeholder-float--blue floating-placeholder-float--huge link-for-input-action-container">
        <input type="checkbox" name="update_default" value="1"
               {{ $statut->is_default?'checked':'' }}  id="update_default-{{$statut->id}}">
        <label for="update_default-{{$statut->id}}" class="">En faire le statut par
            défaut (un seul possible)</label>
        @include('errors.error_field',['field'=>'update_default','name'=>'en faire le statut par défaut'])
    </div>
@endif
@include('forms.partials.required--message')
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn btn--small']) !!}
</div>