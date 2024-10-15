document.getElementById("qty").addEventListener('change',()=>{

    let data = Math.random().toString(36).substr(2, 9);
    data += Date.now().toString();
    data += navigator.userAgent;
    data += window.location.hostname;

    // Creating MD5 hash of the data
    let uuid = CryptoJS.MD5(data).toString();

    console.log('Generated UUID:', uuid);

    let price = parseFloat(document.getElementById('price').value);
    let qty = parseFloat(document.getElementById('qty').value);
    let amt = price * qty;
    let total_amt = amt + 100;

    // Creating the message string
    let message = "total_amount=" + total_amt.toFixed(2) + ",transaction_uuid=" + uuid + ",product_code=EPAYTEST";

    // Creating HMAC SHA256 hash
    let hash = CryptoJS.HmacSHA256(message, '8gBm/:&EnhH.1/q');
    let hashInBase64 = CryptoJS.enc.Base64.stringify(hash);

    // Setting the values in the input fields
    document.getElementById('amount').value = amt.toFixed(2);
    document.getElementById('transaction_uuid').value = uuid;
    document.getElementById('total_amount').value = total_amt.toFixed(2);
    document.getElementById('signature').value = hashInBase64;

    console.log('Amount:', amt);
    console.log('Total Amount:', total_amt);
    console.log('Signature:', hashInBase64);
});

