Ext.define('App.view.ViewportController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.viewport',
    newRecordId: '',
    isNewRecord: false,
    onGridEditorBeforeEdit: function (editor, ctx, eOpts) {
        this.lookupReference('newRecordButton').setDisabled(true);
        var vendorColIdx = 2;
        var combo = ctx.grid.columns[vendorColIdx].getEditor(ctx.record);
        if (ctx.record.get('vendorId') === -1) {
            combo.emptyText = 'Select a vendor...';
        }
    },
    onGridEditorCancelEdit: function (editor, ctx, eOpts) {
        if (this.newRecordId && ctx.record.get('id') === this.newRecordId && this.isNewRecord) {
            ctx.grid.getStore().remove(ctx.record);
            this.isNewRecord = false;
            this.newRecordId = null;
        }
        this.lookupReference('newRecordButton').setDisabled(false);
    },
    onGridEditorEdit: function (editor, ctx, eOpts) {
        var vendorColIdx = 2;
        var combo = ctx.grid.columns[vendorColIdx].getEditor(ctx.record);
        var vendorRecord = combo.findRecord('name', ctx.record.get('vendorName'));
        ctx.record.set('vendorId', vendorRecord.get('id'));
        ctx.grid.getStore().sync();  // Force a post with the updated data.
        this.isNewRecord = false;
        this.newRecordId = null;
        this.lookupReference('newRecordButton').setDisabled(false);
        this.lookupReference('deleteRecordButton').setDisabled(true);
    },
    onNewButtonClick: function (button, evt) {
        var newCar = Ext.create('App.model.ModelCar', {
            category: '',
            name: '',
            vendorId: -1,
            vendorName: ''
        });
        this.isNewRecord = true;
        this.newRecordId = newCar.get('id');
        var grid = this.lookupReference('modelCarsGrid');
        grid.getStore().insert(0, newCar);
        grid.getPlugin('modelCarsRowEditingPlugin').startEdit(newCar);
    },
    onDeleteButtonClick: function (button, evt) {
        var grid = this.lookupReference('modelCarsGrid'),
            selectedRecords = grid.getSelection(),
            store = grid.getStore();
        store.remove(selectedRecords);
        store.sync(); this.lookupReference('deleteRecordButton').setDisabled(true);
    },
    onGridSelect: function (rowModel, record, idx, eOpts) {
        this.lookupReference('deleteRecordButton').setDisabled(false);
    },
    onGridDeselect: function (rowModel, record, idx, eOpts) {
        this.lookupReference('deleteRecordButton').setDisabled(true);
    }
});