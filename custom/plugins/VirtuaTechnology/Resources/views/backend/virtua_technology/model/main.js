Ext.define('Shopware.apps.VirtuaTechnology.model.Main', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'VirtuaTechnology',
            detail: 'Shopware.apps.VirtuaTechnology.view.detail.Container'
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

