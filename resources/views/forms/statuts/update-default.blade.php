<div class="floating-placeholder form-group floating-placeholder-float--blue ">
    {!! Form::label('statut_id','Définissez le statut par défaut',['class'=>'floating-placeholder__label']) !!}
    <select name="statut_id" id="statut_id" class="mask" data-type="select">
        @foreach($statuts as $statut)
            <?php $selectInfo= !!$statut->is_default ?  'Default': 'undefined' ?>
            <option value="{!! $statut->id !!}"
                    data-info-select="{!! $selectInfo !!}">{!! $statut->name !!}</option>
        @endforeach
    </select>
    @include('errors.error_field',['field'=>'statut_id','name'=>'définissez le statut par défaut'])
</div>
<div class="form-group">
    {!! Form::submit($submit,['class'=>'btn btn--small']) !!}
</div>