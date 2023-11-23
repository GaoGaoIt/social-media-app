$(document).ready(function () {
    $('#searchForm').submit(function (e) {
        e.preventDefault();

        // Get the search query
        var query = $('input[type=search]').val();

        // Make an AJAX request
        $.ajax({
            type: 'POST',
            url: '../Admin/index.php',
            data: { query: query, action: 'performSearch' }, // Include an action parameter
            success: function (data) {
                // Display the results in the searchResults container
                $('#searchResults').html(data);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
});