<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
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
                        <h4>User login
                            <a href="{{ url('/') }}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="login" action="{{url('/login')}}" method="POST">
                        @csrf
                            <div class="mb-3">
                                <label for="emailid">Email id:</label>
                                <input type="email" name="emailid" id="emailid" class="form-control"></br>
                                <span id="emailidError" class="text-danger"></span>
                            </div>

                            <div class="mb-3">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control"></br>
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

            function showMessage(message, type){
                $('#message').text(message).addClass(`alert-${type}`).show();
            }
            
            const validateEmail = emailid => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailid);
            const validatePassword = password => password.length >= 6;

            $('#emailid, #password').focus(function() {
                clearError(`#${this.id}Error`);
            });

            $('#emailid').blur(function() {
                const emailid = $(this).val();
                if (!emailid) {
                    showError('#emailidError', 'Email id is required');
                } else if (!validateEmail(emailid)) {
                    showError('#emailidError', 'Invalid Email id');
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

            $('#login').submit(async function(e) {
                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                e.preventDefault();

                clearError('#emailidError');
                clearError('#passwordError');

                const emailid = $('#emailid').val();
                const password = $('#password').val();

                let valid = true;
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
                
                try{
                    const response = await fetch('/login',{
                        method: 'POST',
                        headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': csrfToken
                        },
                        body: JSON.stringify({emailid, password})
                    });
                    const result = await response.json();
                    if(response.ok){
                        showMessage(result.message, 'success');
                        window.location.href = '/users-list';
                    }else{
                        showMessage(result.message, 'danger');
                    }
                }catch(error){
                    showMessage('An error occurred. Please try again.', 'danger');
                }
            });
        });
    </script>
</body>

</html>