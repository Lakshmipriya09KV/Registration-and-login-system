<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>

<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-12">

                <h2 class="mb-5 text-center">User list</h2>
                <div id="message" class="alert" role="alert" style="display: none;"></div>

                <div class="card">
                    <div class="card-header">
                        <h4>Users
                            <button id="logout" class="btn btn-primary float-end">Logout</button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="userTable" >
                            <thead >
                                <tr>
                                    <th>Username</th>
                                    <th>Email id</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        alert('hello');
        $(document).ready(async function(e) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            function showMessage(message, type) {
                $('#message').text(message).removeClass('alert-success alert-danger').addClass(`alert-${type}`).show();
            };
            console.log('hello');
            try {
                const response = await fetch('/get-users-list');
                
                
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const getusersList = await response.json();
                console.log('Fetched usersList:', getusersList);
  
                const tableBody = $('#userTable tbody');
                tableBody.empty();
                getusersList.forEach(user => {
                    const row = `<tr>
                            <td>${user.username}</td>
                            <td>${user.emailid}</td>
                         </tr>`;
                    tableBody.append(row);
                });
            } catch (error) {
                showMessage('An error occurred while loading the users.', 'danger')
            }

        // $(document).ready(function() {
        //     function showMessage(message, type) {
        //         $('#message').text(message).removeClass('alert-success alert-danger').addClass(`alert-${type}`).show();
        //     }

        //     async function fetchUsers() {
        //         try {
        //             const response = await fetch('<?php echo e(url("api/users-list")); ?>', {
        //                 method: 'GET',
        //                 headers: {
        //                     'Accept': 'application/json',
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 }
        //             });

        //             if (!response.ok) {
        //                 throw new Error('Network response was not ok');
        //             }

        //             const usersList = await response.json();
        //             console.log('Fetched usersList:', usersList);

        //             const tableBody = $('#userTable tbody');
        //             tableBody.empty();

        //             usersList.forEach(user => {
        //                 const row = `<tr>
        //                                 <td>${user.username}</td>
        //                                 <td>${user.email}</td>
        //                              </tr>`;
        //                 tableBody.append(row);
        //             });
        //         } catch (error) {
        //             console.error('Error fetching users:', error);
        //             showMessage('An error occurred while loading the users.', 'danger');
        //         }
        //     }

        //     fetchUsers();
            $('#logout').click(async function(e) {
                try {
                    const response = await fetch('/logout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': csrfToken
                        }
                    });
                    const result = await response.json();
                    if (response.ok) {
                        window.location.href = '/login';
                    } else {
                        showMessage(result.message, 'danger');
                    }
                } catch (error) {
                    showMessage('An error occurred during logout.', 'danger');
                }
            });
        });
    </script>
</body>

</html><?php /**PATH E:\lakshmipriya\laravel\task\resources\views/users-list.blade.php ENDPATH**/ ?>