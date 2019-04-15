
Ext.define('Shopware.apps.VirtuaFeaturedProducts.store.Main', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'VirtuaFeaturedProducts'
        };
    },
    model: 'Shopware.apps.VirtuaFeaturedProducts.model.Main'
});