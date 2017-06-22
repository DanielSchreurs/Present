<ul class="box">
    <li class="box-header beta">
        Vos plages horaires
    </li>
    <li class=" box__item--small">
        @include('forms.partials.base-info--important',['message'=>'Définissez les plages horaires par défaut, qui apparaitront lors de la création des séances.'])
        {!! Form::model($user,['action' => ['Www\UserController@updateTimeZoneConfig'],'method'=>'patch']) !!}
            @include('forms.users.edit-time',['submit'=>'Mettre à jour les plages horaire'])
        {!! Form::close() !!}
    </li>
</ul>