<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-12">

                <h2 class="mb-5 text-center">Simple registration and login system</h2>
                <div id="message" class="alert" role="alert" style="display: none;"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>User registration
                            <a href="<?php echo e(url('/login')); ?>" class="btn btn-primary float-end">Login</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="register">
                        <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control"></br>
                                <div id="usernameError" class="text-danger"></div>
                            </div>

                            <div class="mb-3">
                                <label for="emailid">Email id:</label>
                                <input type="email" name="emailid" id="emailid" class="form-control"></br>
                                <div id="emailidError" class="text-danger"></div>
                            </div>

                            <div class="mb-3">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control"></br>
                                <div id="passwordError" class="text-danger"></div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            function showError(selector, message) {
                $(selector).text(message);
            }

            function clearError(selector) {
                $(selector).text('');
            }

            function showMessage(message, type) {
                $('#message').text(message).addClass(`alert-${type}`).show();
            }

            const validateUsername = username => /^[a-zA-Z0-9]{3,}$/.test(username);
            const validateEmail = emailid => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailid);
            const validatePassword = password => password.length >= 6;

            $('#username, #emailid, #password').focus(function() {
                clearError(`#${this.id}Error`);
            });

            $('#username').blur(function() {
                const username = $(this).val();
                if (!username) {
                    showError('#usernameError', 'Username is required');
                } else if (!validateUsername(username)) {
                    showError('#usernameError', 'Username must be alphanumeric and at least 3 characters long');
                }
            });

            $('#emailid').blur(function() {
                const emailid = $(this).val();
                if (!emailid) {
                    showError('#emailidError', 'Email id is required.');
                } else if (!validateEmail(emailid)) {
                    showError('#emailidError', 'Invalid email id.');
                }
            });

            $('#password').blur(function() {
                const password = $(this).val();
                if (!password) {
                    showError('#passwordError', 'Password is required.');
                } else if (!validatePassword(password)) {
                    showError('#passwordError', 'Password must be at least 6 characters long.');
                }
            });

            $('#register').submit(async function(e) {
                e.preventDefault();
                clearError('#usernameError');
                clearError('#emailidError');
                clearError('#passwordError');
                $('message').hide();

                const username = $('#username').val();
                const emailid = $('#emailid').val();
                const password = $('#password').val();

                let valid = true;
                if (!username) {
                    showError('#usernameError', 'Username is required');
                    valid = false;
                } else if (!validateUsername(username)) {
                    showError('#usernameError', 'Username must be alphanumeric and at least 3 characters long');
                    valid = false;
                }

                if (!emailid) {
                    showError('#emailidError', 'Email id is required');
                    valid = false;
                } else if (!validateEmail(emailid)) {
                    showError('#emailidError', 'Invalid Email id');
                    valid = false;
                }

                if (!password) {
                    showError('#passwordError', 'Password is required.');
                    valid = false;
                } else if (!validatePassword(password)) {
                    showError('#passwordError', 'Password must be at least 6 characters long.');
                    valid = false;
                }

                if (!valid) return;

                try {
                    const response = await fetch('/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': csrfToken
                        },
                        body: JSON.stringify({
                            username,
                            emailid,
                            password
                        })
                    });
                    
                    const result = await response.json();
                    if (response.ok) {
                        showMessage(result.message, 'success');
                        $('#register')[0].reset();
                    } else {
                        showMessage(result.message, 'danger');
                    }
                } catch (error) {
                    showMessage('An error occurred. Please try again.', 'danger');
                }
            });
        });
    </script>
</body>

</html><?php /**PATH E:\lakshmipriya\laravel\task\resources\views/register.blade.php ENDPATH**/ ?>