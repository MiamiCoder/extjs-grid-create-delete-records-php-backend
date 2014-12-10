Ext.define('App.store.Vendors', {
    extend: 'Ext.data.Store',
    model: 'App.model.Vendor',
    sorters: ['vendorName'],
    autoLoad: true,
    proxy: {
        type: 'ajax',
        url: 'vendors.php',
        reader: {
            type: 'json',
            rootProperty: 'vendors'
        }
    }
});