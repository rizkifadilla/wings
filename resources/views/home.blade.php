<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Document Code</th>
                        <th scope="col">Document Number</th>
                        <th scope="col">User</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <th scope="row">{{ $transaction['transactionId'] }}</th>
                        <td>{{ $transaction['documentCode'] }}</td>
                        <td>{{ $transaction['documentNumber'] }}</td>
                        <td>{{ $transaction['name'] }}</td>
                        <td>{{ $transaction['status'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
