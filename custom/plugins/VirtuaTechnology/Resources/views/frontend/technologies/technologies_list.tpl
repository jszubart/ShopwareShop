<div class="content--description ">
    <h3>Technologies on this article</h3>
    <div style="position: relative">
        {foreach $technologies as $technology}
            <div class="is--inline-block ">
                <img src="{$technology.logo}" width="200" height="200" alt="">
                <a style="font-weight: bold; font-size: medium" href={url module='frontend' controller='technologies' action={$technology.url}}>{$technology.name}</a>
                <p>{$technology.description|truncate:20}</p>
            </div>
        {/foreach}
    </div>
</div>
