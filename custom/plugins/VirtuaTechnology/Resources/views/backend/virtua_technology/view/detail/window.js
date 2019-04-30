
Ext.define('Shopware.apps.VirtuaTechnology.view.detail.Window', {
    extend: 'Shopware.window.Detail',
    alias: 'widget.virtua-technology-detail-window',

    title : '{s name=title}Virtua Technology details{/s}',
    height: 420,
    width: 900,

    picture: {
        xtype: 'shopware-media-field',
        fieldLabel: '{s name=picture}Image{/s}',
        valueField: 'path',
        allowBlank: false,
    }, //url empty
});
