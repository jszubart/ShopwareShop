{extends file='parent:frontend/detail/content/buy_container.tpl'}

{block name='frontend_widgets_delivery_infos'}
    {action module='widgets' controller='DeliveryDate' action='deliveryInformation' shippingIn={$sArticle.shipping_in}}
    <div class="product--delivery">
        <p class="delivery--information">
            <span class="delivery--text delivery--text-available">
                Delivery time appr. {$sArticle.shipping_in} workday(s)
            </span>
        </p>
    </div>
{/block}