<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-12">

                <h2 class="mb-5 text-center">Simple registration and login system</h2>

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>User registration
                            <a href="{{ url('/login') }}" class="btn btn-primary float-end">Login</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="register" action="{{url('/')}}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{old('username')}}"></br>
                                <span id="usernameError" class="text-danger"></span>
                            </div>

                            <div class="mb-3">
                                <label for="emailid">Email id:</label>
                                <input type="email" name="emailid" id="emailid" class="form-control" value="{{old('emailid')}}"></br>
                                <span id="emailError" class="text-danger"></span>
                            </div>

                            <div class="mb-3">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" value="{{old('password')}}"></br>
                                <span id="passwordError" class="text-danger"></span>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" value="submit">Register</button>
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
            function showError(selector, message) {
                $(selector).text(message);
            }

            function clearError(selector) {
                $(selector).text('');
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
                showError('#emailError', 'Email id is required');
            } else if (!validateEmail(emailid)) {
                showError('#emailError', 'Invalid Email id');
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

        $('#register').submit(function(e) {
            let valid = true;

            clearError('#usernameError');
            clearError('#emailError');
            clearError('#passwordError');

            const username = $('#username').val();
            const emailid = $('#emailid').val();
            const password = $('#password').val();

            if (!username) {
                showError('#usernameError', 'Username is required');
                valid = false;
            } else if (!validateUsername(username)) {
                showError('#usernameError', 'Username must be alphanumeric and at least 3 characters long');
                valid = false;
            }

            if (!emailid) {
                showError('#emailError', 'Email id is required');
                valid = false;
            } else if (!validateEmail(emailid)) {
                showError('#emailError', 'Invalid Email id');
                valid = false;
            }

            if (!password) {
                showError('#passwordError', 'Password is required.');
                valid = false;
            } else if (!validatePassword(password)) {
                showError('#passwordError', 'Password must be at least 6 characters long.');
                valid = false;
            }

            if (!valid) e.preventDefault(); 
        });
        });
    </script>
</body>

</html>