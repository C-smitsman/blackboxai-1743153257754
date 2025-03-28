<?php
// Database connection simulation
$db_connected = false;
try {
    // Simulate database connection
    $db_connected = true;
} catch (Exception $e) {
    $db_error = $e->getMessage();
}

// Form handling
$form_submitted = false;
$form_data = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_submitted = true;
    $form_data = [
        'name' => htmlspecialchars($_POST['name'] ?? ''),
        'email' => htmlspecialchars($_POST['email'] ?? ''),
        'message' => htmlspecialchars($_POST['message'] ?? '')
    ];
    
    // Simulate saving to database
    if ($db_connected) {
        $save_success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8 text-blue-600">
            <i class="fas fa-code mr-2"></i>PHP Application
        </h1>

        <!-- Database Status -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Database Status</h2>
            <?php if ($db_connected): ?>
                <p class="text-green-600"><i class="fas fa-check-circle mr-2"></i>Connected to database</p>
            <?php else: ?>
                <p class="text-red-600"><i class="fas fa-times-circle mr-2"></i>Database connection failed</p>
                <?php if (isset($db_error)): ?>
                    <p class="text-gray-600 mt-2">Error: <?= $db_error ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Contact Form -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Contact Form</h2>
            <form method="POST" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea id="message" name="message" rows="4" required 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"></textarea>
                </div>
                <button type="submit" 
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-paper-plane mr-2"></i>Submit
                </button>
            </form>
        </div>

        <!-- Form Submission Results -->
        <?php if ($form_submitted): ?>
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <h2 class="text-xl font-semibold mb-4">Submission Results</h2>
                <?php if (isset($save_success) && $save_success): ?>
                    <p class="text-green-600"><i class="fas fa-check-circle mr-2"></i>Form submitted successfully!</p>
                <?php else: ?>
                    <p class="text-yellow-600"><i class="fas fa-exclamation-triangle mr-2"></i>Form submitted but not saved to database</p>
                <?php endif; ?>
                <div class="mt-4 p-4 bg-gray-50 rounded">
                    <h3 class="font-medium">Submitted Data:</h3>
                    <pre class="mt-2 text-sm text-gray-600"><?= print_r($form_data, true) ?></pre>
                </div>
            </div>
        <?php endif; ?>

        <!-- Sample Data Display -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Sample Data</h2>
            <?php
            // Simulate database records
            $sample_data = [
                ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
                ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
                ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com']
            ];
            ?>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($sample_data as $item): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $item['id'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $item['name'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $item['email'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-edit"></i> Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>