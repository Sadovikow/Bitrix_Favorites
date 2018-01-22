<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
$GLOBALS['APPLICATION']->RestartBuffer();

/* Избранное */
   global $APPLICATION;
   if($_GET['id'])
   {
      if(!$USER->IsAuthorized()) // Для неавторизованного
      {
        $arElements = unserialize($APPLICATION->get_cookie('favorites'));

        if(!in_array($_GET['id'], $arElements))
        {
               $arElements[] = $_GET['id'];
               $result = 1; // Датчик. Добавляем
        }
        else {
            $key = array_search($_GET['id'], $arElements); // Находим элемент, который нужно удалить из избранного
            unset($arElements[$key]);
            $result = 2; // Датчик. Удаляем
        }
        $APPLICATION->set_cookie("favorites", serialize($arElements));
      }
      else { // Для авторизованного
         $idUser = $USER->GetID();
         $rsUser = CUser::GetByID($idUser);
         $arUser = $rsUser->Fetch();
         $arElements = $arUser['UF_FAVORITES'];  // Достаём избранное пользователя

         if(!in_array($_GET['id'], $arElements)) // Если еще нету этой позиции в избранном
         {
            $arElements[] = $_GET['id'];
            $result = 1;
         }
         else {
            $key = array_search($_GET['id'], $arElements); // Находим элемент, который нужно удалить из избранного
            unset($arElements[$key]);
            $result = 2;
         }
         $USER->Update($idUser, Array("UF_FAVORITES"=>$arElements )); // Добавляем элемент в избранное
      }
   }
/* Избранное */

echo json_encode($result);

 die(); ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>