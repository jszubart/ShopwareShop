
Ext.define('Shopware.apps.TechnologyPlugin.view.detail.Window', {
    extend: 'Shopware.window.Detail',
    alias: 'widget.technology-plugin-detail-window',

    title : '{s name=title}Technology plugin details{/s}',
    height: 420,
    width: 900,

    picture: {
        xtype: 'shopware-media-field',
        fieldLabel: '{s name=picture}Image{/s}',
        valueField: 'path',
        allowBlank: false,
    },
});
