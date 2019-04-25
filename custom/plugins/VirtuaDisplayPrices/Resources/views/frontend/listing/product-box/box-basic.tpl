{extends file='parent:frontend/listing/product-box/box-basic.tpl'}

{block name='frontend_listing_box_article_price'}
    {if $sUserLoggedIn || !$hidePrices}
        {$smarty.block.parent}
    {/if}
{/block}
