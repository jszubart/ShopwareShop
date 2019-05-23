{extends file='parent:frontend/checkout/items/product.tpl'}

{block name='frontend_checkout_cart_item_delivery_informations'}
    {if {config name=BasketShippingInfo} && $sBasketItem.shippinginfo}
        {action module='widgets' controller='DeliveryDate' action='deliveryInformation' shippingIn={$sBasketItem.additional_details.shipping_in}}
        <div class="product--delivery">
            <p class="delivery--information">
            <span class="delivery--text delivery--text-available">
                Delivery time appr. {$sBasketItem.additional_details.shipping_in} workday(s)
            </span>
            </p>
        </div>
    {/if}
{/block}