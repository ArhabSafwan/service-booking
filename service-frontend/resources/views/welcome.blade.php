<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card mt-5">
                        <div class="card-header">
                            <h4>Login</h4>
                        </div>
                        <div class="card-body">
                            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                            <form id="loginForm">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- jQuery CDN -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        
        <script>
            $(document).ready(function() {
                $('#loginForm').on('submit', function(e) {
                    e.preventDefault();

                    const email = $('#email').val();
                    const password = $('#password').val();
                    const errorMessageDiv = $('#error-message');
                    
                    const apiUrl = 'http://service.backend.booking.local/api/login';

                    $.ajax({
                        url: apiUrl,
                        type: 'POST',
                        contentType: 'application/json',
                        headers: {
                            'Accept': 'application/json'
                        },
                        data: JSON.stringify({ email: email, password: password }),
                        success: function(data) {
                            errorMessageDiv.hide();
                            if(data.token) {
                                localStorage.setItem('auth_token', data.token);
                            }
                            alert('Login successful!');
                            // window.location.href = '/dashboard';
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error during login:', jqXHR.responseText);
                            let errorMessage = 'Login failed.';
                            try {
                                const errorData = JSON.parse(jqXHR.responseText);
                                if (errorData.message) {
                                    errorMessage = errorData.message;
                                }
                                if (errorData.errors) {
                                    errorMessage = Object.values(errorData.errors).flat().join('\n');
                                }
                            } catch (e) {
                                errorMessage = 'An unknown error occurred.';
                            }
                            errorMessageDiv.text(errorMessage).show();
                        }
                    });
                });
            });
        </script>
    </body>
</html>
