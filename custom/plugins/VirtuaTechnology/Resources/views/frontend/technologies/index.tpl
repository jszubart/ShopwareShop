{extends file="parent:frontend/index/index.tpl"}

{block name="frontend_index_content_left"}{/block}

{block name="frontend_index_content"}
    <h2>List of technologies</h2>
    {foreach $technologies as $technology}
        <div class="product--box" >
            <div class="product--image">
                <img src="{$technology.logo}" alt=""/>
            </div>
            <a class="product--title" href={url module='frontend' controller='technologies' action={$technology.url}}>{$technology.name}</a>
        </div>
    {/foreach}
{/block}

