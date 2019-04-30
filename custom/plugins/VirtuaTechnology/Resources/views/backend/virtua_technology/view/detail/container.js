
Ext.define('Shopware.apps.VirtuaTechnology.view.detail.Container', {
    extend: 'Shopware.model.Container',
    padding: 20,

    configure: function() {
        return {
            controller: 'VirtuaTechnology',
            fieldSets: [{
                title: 'Technology Data',
                fields: {
                    name: {},
                    description: {}
                }
            }, {
                title: 'Technology logo',
                layout: 'fit',
                fields: {
                    logo: {}
                }
            }]
        };
    },
});