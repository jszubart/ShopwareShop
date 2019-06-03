
Ext.define('Shopware.apps.TechnologyPlugin', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.TechnologyPlugin',

    loadPath: '{url action=load}',
    bulkLoad: true,

    controllers: [ 'Main' ],

    views: [
        'list.Window',
        'list.List',

        'detail.Container',
        'detail.Window'
    ],

    models: [ 'Main' ],
    stores: [ 'Main' ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});