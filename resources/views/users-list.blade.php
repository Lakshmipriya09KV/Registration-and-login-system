<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container m-5">
        <div class="row">
            <div class="col-md-12">

            <h2 class="mb-5 text-center">User list</h2>

                <div class="card">
                    <div class="card-header">
                        <h4>Users
                            <a href="{{ url('/login') }}" class="btn btn-primary float-end">Logout</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($emp as $items)
                                <tr>
                                    <td>{{ $items->username }}</td>
                                    <td>{{ $items->emailid }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>