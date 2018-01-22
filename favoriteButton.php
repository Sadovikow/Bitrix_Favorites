<?
 /* Вывод количества избранного */
    if(!$USER->IsAuthorized()) // Для неавторизованного
    {
            $arElements = unserialize($APPLICATION->get_cookie('favorites'));
            $wishCount = count($arElements);
    }
    else {
         $idUser = $USER->GetID();
         $rsUser = CUser::GetByID($idUser);
         $arUser = $rsUser->Fetch();
         $wishCount = count($arUser['UF_FAVORITES']);
     }
 /* Вывод количества избранного */
?>
<a id='want' class="block" href="/personal/wishlist/">
    <span class="col"><?=$wishCount?></span>
    <div class="icon"></div>
    <p>Хочу</p>
</a>