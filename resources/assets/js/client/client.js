listenClick('.client-delete-btn', function (event) {
    let recordId = $(event.currentTarget).attr('data-id');
    deleteItem(route('clients.destroy', recordId), '#client',
        Lang.get('messages.client.client'));
})
