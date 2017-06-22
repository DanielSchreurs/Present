<ul class="tunel">
    @for($i=1;$i<=$iMaxStep;$i++)
        <li class="tunel__item {!! $iC==$i?'tunel__item--is-current':'' !!}">
            {!! Html::linkAction('Www\UserController@getStarted',$i,['start_step'=>$i]) !!}
        </li>
    @endfor
</ul>