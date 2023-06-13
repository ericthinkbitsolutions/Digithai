<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Company Created</title>
</head>
<body>
    <h1>New Company Created</h1>
    <p>A new company has been created:</p>
    
    <ul>
        <li><strong>Company Name:</strong> {{ $company->name }}</li>
        <li><strong>Company Address:</strong> {{ $company->address }}</li>
        <!-- Add more details as needed -->
    </ul>
    
    <p>Thank you for your attention.</p>
</body>
</html>
