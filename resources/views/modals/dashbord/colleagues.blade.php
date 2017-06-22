<?php $schools=Auth::user()->schools ?>
<ul class="box">
    <li class="box-header betae">{!! link_to_action('Www\UserController@index','Mes collègues') !!}</li>
    <li class="box__item"><a href="#" class="btn btn--small">Inviter des collègues à connaître cet outil.</a></li>
</ul>