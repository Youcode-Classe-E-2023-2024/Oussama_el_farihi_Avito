<?php
include 'connection.php';

// Fetch product details for editing
$product_id = $_GET['id'];
$select_query = "SELECT * FROM annonce WHERE id = ?";
$stmt = $conn->prepare($select_query);
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// Process product update
if (isset($_POST['update'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];

    $update_query = "UPDATE annonce SET titre = ?, description = ?, prix = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('ssdi', $product_title, $product_description, $product_price, $product_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully'); window.location.href='dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to update product: " . $stmt->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Product</title>
</head>

<body>
    <div class="min-h-full">
        <nav class="bg-gray-800">
            <!-- Navigation code here... (same as dashboard.php) -->
        </nav>

        <header class="bg-white shadow">
            <!-- Header code here... (same as dashboard.php) -->
        </header>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="mt-6">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900">Edit Product</h2>
                </div>

                <form method="POST">
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="col-span-6 sm:col-span-4">
                            <label for="product_title" class="block text-sm font-medium leading-6 text-gray-900">Product Title</label>
                            <input type="text" name="product_title" id="product_title" autocomplete="street-address" value="<?php echo $product['titre']; ?>" class="mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="col-span-6">
                            <label for="product_description" class="block text-sm font-medium leading-6 text-gray-900">Product Description</label>
                            <textarea id="product_description" name="product_description" rows="3" class="mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"><?php echo $product['description']; ?></textarea>
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="product_price" class="block text-sm font-medium leading-6 text-gray-900">Product Price</label>
                            <input type="number" name="product_price" id="product_price" autocomplete="address-level2" value="<?php echo $product['prix']; ?>" class="mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit" name="update" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                        <a href="dashboard.php" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>