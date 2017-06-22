@include('forms.filter.link-show')
{!! Form::open(['action' =>'Www\UserController@updateIndexMeta','method'=>'patch','class'=>'filter-result filter-result--small']) !!}
<div class="filter-result__item">
    <input type="radio" name="index_view_student_list_block" value="0"
           {{ $meta['index_view_student_list_block']==0?'checked':'' }} id="orderList"
           class="visuallyhidden radio-svg-input">
    <label data-toggle="tooltip" data-title="Affichez vos élèves en liste sans les cours et les classes" for="orderList" class="filter-result__item--checked">
        <span class="visuallyhidden">En liste</span>
        <svg class="svg-basic svg--cheked filter-result__item__el">
            <use xlink:href="#shape-list"></use>
        </svg>
    </label>
    <input type="radio" name="index_view_student_list_block" id="orderBlock"
           {{ $meta['index_view_student_list_block']==1?'checked':'' }} value="1"
           class="visuallyhidden radio-svg-input">
    <label data-toggle="tooltip" data-title="Affichez vos élèves en bloc avec les cours et les classes" for="orderBlock" class="filter-result__item--checked">
        <span class="visuallyhidden">En block</span>
        <svg class="svg-basic svg--cheked filter-result__item__el">
            <use xlink:href="#shape-block"></use>
        </svg>
    </label>
    @include('errors.error_field',['field'=>'index_view_student_list_block','name'=>'en liste/ou en block'])
</div>
<div class="filter-result__item filter-result__item--nbr-result">
    <label for="index_view_student_nbr_pagination" class="filter-result__item__label floating-placeholder__label">Nbr.
        de résultats @include('forms.partials.required')</label>
    {!! Form::select('index_view_student_nbr_pagination',config('app.defaultIndexPaginationStudent'),$meta['index_view_student_nbr_pagination'],['class'=>'mask',"data-type"=>"select",'id'=>'index_view_student_nbr_pagination']) !!}
    @include('errors.error_field',['field'=>'index_view_student_nbr_pagination','name'=>'nbr. de résultats'])
</div>
{{--    <div class="filter-result__item">
        <label for="nbr" class="filter-result__item__label floating-placeholder__label">L’ordre @include('forms.partials.required')</label>
        {!! Form::select('order',['order'=>'Du plus récent','orderInverse'=>'Du plus ancien'],old('order'),['class'=>'mask',"data-type"=>"select",'id'=>'nbr']) !!}
        @include('errors.error_field',['field'=>'nbr'])
    </div>--}}
@unless($classes->count()<1)
    <div class="filter-result__item filter-result__item--classe">
        <label for="index_view_student_classe_id" class="filter-result__item__label floating-placeholder__label">Par
            classe @include('forms.partials.required')</label>
        {!! Form::select('index_view_student_classe_id',$classes,$meta['index_view_student_classe_id'],['class'=>'mask',"data-type"=>"select",'id'=>'index_view_student_classe_id']) !!}
        @include('errors.error_field',['field'=>'index_view_student_classe_id','name'=>'Par classe'])
    </div>
@endunless
<div class="filter-result__item filter-result__item--submit">
    {!! Form::submit('filtrez !',['class'=>'btn filter-result__item--submit__btn']) !!}
</div>
{!! Form::close() !!}
