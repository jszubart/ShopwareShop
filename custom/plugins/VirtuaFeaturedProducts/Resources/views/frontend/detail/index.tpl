{extends file="parent:frontend/detail/index.tpl"}

{block name='frontend_detail_index_data'}
    {if $sArticle.is_featured}
        <div>
            <a>Featured Product!!</a>
        </div>
    {/if}
    {$smarty.block.parent}
{/block}