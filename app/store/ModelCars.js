Ext.define('App.store.ModelCars', {
    extend: 'Ext.data.Store',
    model: 'App.model.ModelCar',
    sorters: ['name'],
    autoLoad: true,
    autoSync: false,    // Make sure that autosync is disabled to avoid posting invalid vendorName.
    proxy: {
        type: 'ajax',
        url: 'model-cars.php',
        api: {
            create: 'model-cars.php?action=create',
            read: 'model-cars.php?action=read',
            update: 'model-cars.php?action=update',
            destroy: 'model-cars.php?action=destroy'
        },
        reader: {
            type: 'json',
            rootProperty: 'modelCars'
        }
    }
});