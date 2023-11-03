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

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<section class="press-center" data-controller="view-more">
	<header class="press-center__header">
		<h1 class="light"><?$APPLICATION->SetTitle(false)?></h1>
	</header>
<div class="press-center__articles press-center__articles--wide-list" data-target="view-more.container">

	<?$counter = 0;?>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
			<?if($counter > 0):?>
				<article class="news news--wide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="news__publication-info">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news__link">
							<h3 class="news__title content-block"><mark><?=$arItem["NAME"]?></mark>
							<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
								<span><?=$arItem["PREVIEW_TEXT"]?></span>
							<?endif;?>
							</h3>
						</a>
						<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
							<time class="news__publication-date" datetime="<?=$arItem["ACTIVE_FROM"]?>"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></time>
						<?endif?>
					</div>
					<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
					<div class="news__illustration" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)"></div>
					<?endif?>
				</article>
			<?else:?>
				<article class="news-important" style="background-image: url(<?=$arResult["ITEMS"][0]["PREVIEW_PICTURE"]["SRC"]?>)">
					<a href="/article.html" class="news-important__link">
						<h2 class="news-important__title"><?=$arResult["ITEMS"][0]["PREVIEW_TEXT"]?></h2>
					</a>
					<time class="news-important__publication-date" datetime="<?=$arItem["ACTIVE_FROM"]?>"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></time>
				</article>
			<?endif?>
		<?$counter++;?>
	<?endforeach;?>

	</div>
	<div class="grid-container">
	<a class="press-center__view-more button button--inverted" href="press-center.html" data-target="view-more.button"
		data-action="view-more#load"><?= Loc::GetMessage("BTN_MORE"); ?></a>
	</div>
</section>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

