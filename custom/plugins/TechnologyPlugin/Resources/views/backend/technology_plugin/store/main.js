
Ext.define('Shopware.apps.TechnologyPlugin.store.Main', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'TechnologyPlugin'
        };
    },
    model: 'Shopware.apps.TechnologyPlugin.model.Main'
});