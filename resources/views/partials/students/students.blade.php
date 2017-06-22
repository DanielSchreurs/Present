<li class="profile-container layout__item u-2/12 u-2/12-desk u-3/12-lap u-6/12-palm">
    <a href="{!! URL::to('/eleves/blisntin-stephan') !!}" title="Renvoie vers la fiche de l’élèves">
        <img class="profile-picture user-image profile-picture--present"
             src="{!! asset('./img/default_profile_picture.jpg') !!}" alt="">
        <span class="profile-name">{!! $name !!}</span>
    </a>
    <a href="#" class="btn btn--alert">Est absent</a>
</li>