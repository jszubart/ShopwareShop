
Ext.define('Shopware.apps.VirtuaTechnology.store.Main', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'VirtuaTechnology'
        };
    },
    model: 'Shopware.apps.VirtuaTechnology.model.Main'
});