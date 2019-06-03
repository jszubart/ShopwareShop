
Ext.define('Shopware.apps.TechnologyPlugin.view.detail.Container', {
    extend: 'Shopware.model.Container',
    padding: 20,

    configure: function() {
        return {
            controller: 'TechnologyPlugin',
            fieldSets: [{
                title: 'Technology Data',
                fields: {
                    name: {},
                    description: this.createDescription,
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
    createDescription: function(model, formField) {
        formField.xtype = 'textarea';
        formField.height = 90;
        formField.grow = true;
        return formField;
    }
});