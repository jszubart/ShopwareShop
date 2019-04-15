
Ext.define('Shopware.apps.VirtuaFeaturedProducts', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.VirtuaFeaturedProducts',

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