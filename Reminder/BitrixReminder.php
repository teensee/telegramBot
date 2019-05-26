<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("testinfoblock");

?>

<?php

function getUniqueRecordFromBitrix(int $infoBlockId){
    //Select all Unused texts
    if(CModule::IncludeModule("iblock")){

        $arFields = [];

        $arSelect = Array("ID", "IBLOCK_ID","PROPERTY_ISUSED","PROPERTY_BOTALERT");
        $arFilter = Array("IBLOCK_ID" => $infoBlockId, "PROPERTY_ISUSED" => 0);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement()){
            array_push($arFields,$ob->GetFields());
        }
    }

    if(!count($arFields))
    {
        $arSelect = Array("ID", "IBLOCK_ID","PROPERTY_ISUSED","PROPERTY_BOTALERT");
        $arFilter = Array("IBLOCK_ID" => 9);
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement()){
            array_push($arFields,$ob->GetFields());
        }

        $i = 0;
        $len = count($arFields);

        while($i != $len){
            $arr = ["ISUSED" => 0];

            CIBlockElement::SetPropertyValuesEx(
                $arFields[$i]["ID"],
                $arFields[$i]["IBLOCK_ID"],
                $arr
            );

            $i++;
        }
    }

//generate random number 0 ... arFields length
    $rndStuff = rand(0, count($arFields)-1);

    $arr = ["ISUSED" => 1];

    CIBlockElement::SetPropertyValuesEx(
        $arFields[$rndStuff]["ID"],
        $arFields[$rndStuff]["IBLOCK_ID"],
        $arr
    );

    return $arFields[$rndStuff]['PROPERTY_BOTALERT_VALUE'];
}

?>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>