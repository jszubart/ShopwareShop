Ext.define('Shopware.apps.TechnologyPlugin.model.Main', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'TechnologyPlugin',
            detail: 'Shopware.apps.TechnologyPlugin.view.detail.Container'
        };
    },

    fields: [
        { name : 'id', type: 'int', useNull: true },
        { name : 'name', type: 'string' },
        { name : 'description', type: 'string', useNull: true },
        { name : 'logo', type: 'image'},
        { name : 'url', type: 'string'},
    ],
    associations: [{
        relation: 'ManyToOne',
        field: 'logo',
        type: 'hasMany',
        model: 'Shopware.apps.Base.model.Media',
        name: 'getMedia',
        associationKey: 'media'
    }],
});

