<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Register</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card mt-5">
                        <div class="card-header">
                            <h4>Register</h4>
                        </div>
                        <div class="card-body">
                            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                            <div id="success-message" class="alert alert-success" style="display: none;"></div>
                            <form id="registerForm">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Register</button>
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
                $('#registerForm').on('submit', function(e) {
                    e.preventDefault();

                    const name = $('#name').val();
                    const email = $('#email').val();
                    const password = $('#password').val();
                    const password_confirmation = $('#password_confirmation').val();
                    const errorMessageDiv = $('#error-message');
                    const successMessageDiv = $('#success-message');

                    // Clear previous messages
                    errorMessageDiv.hide().text('');
                    successMessageDiv.hide().text('');
                    
                    const apiUrl = 'http://service.backend.booking.local/api/register';

                    $.ajax({
                        url: apiUrl,
                        type: 'POST',
                        contentType: 'application/json',
                        headers: {
                            'Accept': 'application/json'
                        },
                        data: JSON.stringify({
                            name: name,
                            email: email, 
                            password: password,
                            password_confirmation: password_confirmation
                        }),
                        success: function(data) {
                            successMessageDiv.text('Registration successful! You can now log in.').show();
                            // Optionally clear the form
                            $('#registerForm')[0].reset();
                            // Redirect to login page after a short delay
                            // setTimeout(function() {
                            //     window.location.href = '/login'; 
                            // }, 3000);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error during registration:', jqXHR.responseText);
                            let errorMessage = 'Registration failed.';
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