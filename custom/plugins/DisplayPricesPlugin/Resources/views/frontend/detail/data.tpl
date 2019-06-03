{extends file="parent:frontend/detail/data.tpl"}

{block name='frontend_detail_data_price_configurator'}
    {if $sUserLoggedIn || !$hidePrices}
        {$smarty.block.parent}
    {/if}
{/block}

{block name='frontend_detail_data_tax'}
    {if $sUserLoggedIn || !$hidePrices}
        {$smarty.block.parent}
    {/if}
{/block}