{extends file="parent:frontend/index/index.tpl"}

{block name="frontend_index_content_left"}{/block}

{block name="frontend_index_content"}
    <h2>List of technologies</h2>
    {foreach $technologies as $technology}
        <div class="product--box">
            {if $technology.logo != null}
                <div class="product--image">
                    <img style="position:relative;" src="{$technology.logo}" alt="" itemprop="image"/>
                </div>
            {else}
                <div class="product--image">
                    <img style="position:relative;" src="{link file='frontend/_public/src/img/no-picture.jpg'}" alt="" itemprop="image" />
                </div>
            {/if}
            <a class="product--title" href={url module='frontend' controller='technologies' action={$technology.url}}>{$technology.name}</a>
        </div>
    {/foreach}
{/block}

