<?php $user= Auth::user() ?>
<div class="box">
    <div class="box-header">{!! Html::linkAction('Www\UserController@getConfig','Mon compte',[],['title'=>'Renvoie vers la configuration de votre compte']) !!}</div>
    <p class="box__item">{!! $user->first_name !!} {!! $user->last_name !!}</p>
    <p class="box__item">15 heures de cours</p>
    <p class="box__item">200 élèves</p>
</div>