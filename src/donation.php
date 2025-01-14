<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Us - Donate</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
		body {
			margin: 0;
			font-family: Arial, sans-serif;
		}
        .donation-container {
            text-align: center;
            padding: 180px 20px;
        }

        .donation-container h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #333;
        }

        .donation-container p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 30px;
        }

        .donation-options {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .donation-option {
            flex: 0 0 auto;
            background-color: #f4f4f9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 250px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .donation-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .donation-option img {
            width: 100px;
            height: 100px;
            margin-bottom: 15px;
        }

        .donation-option button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        .donation-option button:hover {
            background-color: #0056b3;
        }

        .crypto-details {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/php/header.php'; ?>

    <div class="donation-container">
        <h2>🙏 Support Us with Your Generous Donations! 💖</h2>
        <p>We’re working hard to make this website bigger and better! Your contributions help us organize more exciting events and reach a wider audience. Choose your preferred donation method below:</p>

        <div class="donation-options">
            <!-- Crypto Donation Option -->
            <div class="donation-option">
                <img src="assets/crypto-icon.png" alt="Crypto Donation">
                <h3>Donate via Crypto</h3>
                <button onclick="showCryptoDetails()">View Wallet Details</button>
            </div>

            <!-- Payment Gateway Option -->
            <div class="donation-option">
                <img src="assets/payment-gateway-icon.png" alt="Payment Gateway">
                <h3>Donate via Payment Gateway</h3>
                <button onclick="window.location.href='https://www.paypal.com/donate'">Donate Now</button>
            </div>
        </div>

        <!-- Crypto Wallet Details -->
        <div class="crypto-details" id="crypto-details" style="display: none;">
            <p>🪙 <strong>Bitcoin Wallet:</strong> 1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa</p>
            <p>🪙 <strong>Ethereum Wallet:</strong> 0x123456789ABCDEF123456789ABCDEF1234567890</p>
            <p>💎 <strong>Other Crypto?</strong> Contact us at support@example.com</p>
        </div>
    </div>

    <?php include __DIR__ . '/php/footer.php'; ?>

    <script>
        function showCryptoDetails() {
            const cryptoDetails = document.getElementById('crypto-details');
            cryptoDetails.style.display = cryptoDetails.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>
