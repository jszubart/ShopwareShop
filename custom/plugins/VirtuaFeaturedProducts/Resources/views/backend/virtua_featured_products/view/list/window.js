
Ext.define('Shopware.apps.VirtuaFeaturedProducts.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.virtua-featured-products-list-window',
    height: 450,
    title : '{s name=window_title}VirtuaFeaturedProducts listing{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.VirtuaFeaturedProducts.view.list.List',
            listingStore: 'Shopware.apps.VirtuaFeaturedProducts.store.Main'
        };
    }
});