let table = new DataTable('#example');

table.on('click', 'tbody tr', function () {
    let data = table.row(this).data();

    alert('You clicked on ' + data[0] + "'s row");
});