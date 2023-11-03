<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>
<section class="article">
  <header class="article__header">
    <h1 class="article__title"><?=$arResult["NAME"];?></h1>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<time class="article__publication-date" datetime="2019-06-13"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></time>
	<?endif;?>
    <a class="back-link" href="<?=$arResult["LIST_PAGE_URL"]?>">
      <svg class="icon" role="img">
        <use xlink:href="<?=ASSET_PATH?>icons.svg#dropdown-arrow" /></svg>
		<?= Loc::GetMessage("RETURN_LINK"); ?>
    </a>
  </header>
  <div class="article__content-wrapper">
    <div class="article__lead content-block">
		<?if(strlen($arResult["PREVIEW_TEXT"])>0):?>
			<?=$arResult["DETAIL_TEXT"];?>
		<?endif?>
    </div>
  </div>
  <div class="article__content-wrapper">
    <div class="article__content content-block">
		<?if(strlen($arResult["DETAIL_TEXT"])>0):?>
			<?=$arResult["DETAIL_TEXT"];?>
		<?else:?>
			<?=$arResult["PREVIEW_TEXT"];?>
		<?endif?>
    </div>
  </div>
</section>
<?if($arResult["NAV_RESULT"]):?>
	<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
	<?echo $arResult["NAV_TEXT"];?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
<?endif;?>
	<?if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>