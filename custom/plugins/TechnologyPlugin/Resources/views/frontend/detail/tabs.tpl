{extends file="parent:frontend/detail/tabs.tpl"}

{block name="frontend_detail_tabs_navigation_inner"}
    {$smarty.block.parent}

    {block name="frontend_detail_tabs_technology"}
        <a href="#" class="tab--link" title="Technology" data-tabName="Technology">Technology</a>
    {/block}
{/block}

{block name="frontend_detail_tabs_content_inner"}
    {$smarty.block.parent}
    <div class="tab--container">
        <div class="tab--header">
            <a href="#" class="tab--title" title="Technology">Technology</a>
        </div>
        <div class="tab--preview">
            <p>Technology preview</p>
        </div>
        <div class="tab--content">
            {if not empty($sArticle.technology)}
                {action module='frontend' controller='Technologies' action='technologiesList' numbers=($sArticle.technology)}
            {/if}
        </div>
    </div>
{/block}


