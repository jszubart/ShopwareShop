{block name='frontend_widgets_delivery_DeliveryPlugin'}
    <div class="product--delivery">
        <p class="delivery--information">
            <span class="delivery--text delivery--text-available">
                <i class="delivery--status-icon delivery--status-available"></i>
                    Ships until: {$shipsUntil|date:"TIME_SHORT"}
            </span>
        </p>
        <p class="delivery--information">
            <span class="delivery--text delivery--text-available">
                <i class="delivery--status-icon delivery--status-available"></i>
                Not shipping in:
            </span>
        </p>
        {foreach $notShipping as $day}
            <p class="delivery--information">
                <span class="delivery--text delivery--text-available"> - {$day}</span>
            </p>
        {/foreach}
        <p class="delivery--information">
            <span class="delivery--text delivery--text-available">
                <i class="delivery--status-icon delivery--status-available"></i>
                    Holidays: {$holidaysBegin|date:"DATE_SHORT"} - {$holidaysEnd|date:"DATE_SHORT"}
            </span>
        </p>
        <p class="delivery--information">
            <span class="delivery--text delivery--text-available">
                <i class="delivery--status-icon delivery--status-available"></i>
                    Estimated delivery day - {$shippingDate|date:"DATE_SHORT"}
            </span>
        </p>
    </div>
{/block}