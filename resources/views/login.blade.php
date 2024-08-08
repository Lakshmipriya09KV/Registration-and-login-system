<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                        <h4>User login
                            <a href="{{ url('/') }}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="login" action="{{url('/login')}}" method="POST">
                            @csrf

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
                                <button type="submit" class="btn btn-primary" value="submit">Login</button>
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

            const validateEmail = emailid => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailid);
            const validatePassword = password => password.length >= 6;

            $('#emailid, #password').focus(function() {
                clearError(`#${this.id}Error`);
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

            $('#login').submit(function(e) {
                let valid = true;

                clearError('#emailError');
                clearError('#passwordError');

                const emailid = $('#emailid').val();
                const password = $('#password').val();

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