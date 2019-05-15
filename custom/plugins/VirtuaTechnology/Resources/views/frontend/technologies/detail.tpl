{extends file="parent:frontend/detail/index.tpl"}

{block name="frontend_index_content_left"}{/block}

{block name="frontend_index_content"}
        <h1 class="product--title" itemprop="name">{$technology.name}</h1>
        {if $technology.logo != null}
            <div class="product--box">
                <div class="product--image">
                    <img style="position:relative;" src="{$technology.logo}" alt="" itemprop="image"/>
                </div>
            </div>
        {else}
            <div class="product--image">
                <img style="position:relative;" src="{link file='frontend/_public/src/img/no-picture.jpg'}" alt="" itemprop="image" />
            </div>
        {/if}
        <div class="content--description">
            <h2 class="product--description" itemprop="name">Technology description: "{$technology.name}"</h2>
            <span style="font-family: proxima-nova, sans-serif; font-size: 17px;">{$technology.description}</span>
        </div>
{/block}

