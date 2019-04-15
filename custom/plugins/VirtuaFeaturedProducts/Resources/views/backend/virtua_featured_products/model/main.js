
Ext.define('Shopware.apps.VirtuaFeaturedProducts.model.Main', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'VirtuaFeaturedProducts',
            detail: 'Shopware.apps.VirtuaFeaturedProducts.view.detail.Container'
        };
    },


    fields: [
        { name : 'id', type: 'int', useNull: true },
        { name : 'name', type: 'string', useNull: false }
    ]
});

