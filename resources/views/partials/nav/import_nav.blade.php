<ol class="create-pagination">
    <?php $url = Request::is('add-student-to-classe/' . (isset($classe) ? $classe->slug : ''));?>
    <li class="create-pagination__item {{ Request::is('student-import')||$url? 'create-pagination__item--active' : '' }}">
        <a href="{!! URL::action('Www\StudentController@getImportStudentsList') !!}" class="">Choisissez votre fichier
            (.CSV)</a>
    </li>
    <li class="create-pagination__item {{ Request::is('get-valide-student-importe') ? 'create-pagination__item--active' : '' }}">
        @if(isset($studentImport))
            <a href="{!! URL::action('Www\StudentController@getImportStudentsList') !!}" class="">Validez
                l’importation</a>
        @else
            <span class="disabled">Validez l’importation</span>
        @endif
    </li>
</ol>