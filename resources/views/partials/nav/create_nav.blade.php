<ol class="create-pagination">
    <li class="create-pagination__item {{ $nav=="cours" ? 'create-pagination__item--active' : '' }}">
        {!! Html::linkAction('Www\CoursController@create','Créez un cours',[],['class'=>'match-height']) !!}
    </li>
    <li class="create-pagination__item {{ $nav=='classes' ? 'create-pagination__item--active' : '' }}">
        {!! Html::linkAction('Www\ClassController@create','Créez un classe',[],['class'=>'match-height']) !!}
    </li>
    <li class="create-pagination__item {{ $nav=='students' ? 'create-pagination__item--active' : '' }}">
        {!! Html::linkAction('Www\StudentController@create','Créez un élève',[],['class'=>'match-height']) !!}
    </li>
    <li class="create-pagination__item {{ Request::is('planificate') ? 'create-pagination__item--active' : '' }}">
        {!! Html::linkAction('Www\PresentController@getPlanificateFull','Planifiez des séances',[],['class'=>'match-height']) !!}
    </li>
</ol>