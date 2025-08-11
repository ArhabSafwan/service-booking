<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Our Services</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Available Services</h2>
        <div id="services-list" class="row">
            <!-- Services will be loaded here -->
        </div>
        <div id="message" class="alert" style="display: none;"></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            const authToken = localStorage.getItem('auth_token');
            const servicesListDiv = $('#services-list');
            const messageDiv = $('#message');
            const apiUrl = 'http://service.backend.booking.local/api/services';

            if (!authToken) {
                messageDiv.removeClass('alert-success alert-danger').addClass('alert-warning').text('You are not logged in. Redirecting to login page...').show();
                setTimeout(function () {
                    window.location.href = '/'; // Redirect to login page (welcome.blade.php)
                }, 2000);
                return;
            }

            $.ajax({
                url: apiUrl,
                type: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + authToken
                },
                success: function (response) {
                    if (response.length > 0) {
                        servicesListDiv.empty(); // Clear any existing content
                        $.each(response, function (index, service) {
                            servicesListDiv.append(`
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">${service.name}</h5>
                                                <p class="card-text">${service.description}</p>
                                                <p class="card-text"><strong>Price: $${service.price}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                `);
                        });
                    } else {
                        messageDiv.removeClass('alert-success alert-danger').addClass('alert-info').text('No services available at the moment.').show();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching services:', jqXHR.responseText);
                    let errorMessage = 'Failed to load services.';
                    try {
                        const errorData = JSON.parse(jqXHR.responseText);
                        if (errorData.message) {
                            errorMessage = errorData.message;
                        }
                    } catch (e) {
                        // Fallback to default error message
                    }

                    if (jqXHR.status === 401) {
                        errorMessage = 'Session expired or unauthorized. Please log in again.';
                        messageDiv.removeClass('alert-success alert-info').addClass('alert-danger').text(errorMessage).show();
                        setTimeout(function () {
                            localStorage.removeItem('auth_token'); // Clear invalid token
                            window.location.href = '/'; // Redirect to login
                        }, 2000);
                    } else {
                        messageDiv.removeClass('alert-success alert-info').addClass('alert-danger').text(errorMessage).show();
                    }
                }
            });
        });
    </script>
</body>

</html>
