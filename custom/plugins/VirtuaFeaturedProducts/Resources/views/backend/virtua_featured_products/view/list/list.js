
Ext.define('Shopware.apps.VirtuaFeaturedProducts.view.list.List', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.virtua-featured-products-listing-grid',
    region: 'center',

    configure: function() {
        return {
            detailWindow: 'Shopware.apps.VirtuaFeaturedProducts.view.detail.Window'
        };
    }
});
