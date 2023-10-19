<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher</title>
</head>
<body>
    <h1>Vigenere Cipher</h1>
    <form id="cipher-form">
        <label for="plaintext">Plaintext/Chipertext:</label>
        <!-- Input teks yang akan dienkripsi -->
        <input type="text" id="plaintext" name="plaintext" required><br><br>
        
        <label for="key">Key:</label>
        <!-- Input kunci untuk enkripsi -->
        <input type="text" id="key" name="key" required><br><br>

        <!-- Tombol untuk mengenkripsi dan mendekripsi -->
        <input type="button" value="Deskripsi" onclick="encryptText()">
        <input type="button" value="Enkripsi" onclick="decryptText()">
    </form>

    <h2>Hasil:</h2>
    <!-- Tempat hasil enkripsi atau dekripsi akan ditampilkan -->
    <p id="result"></p>

    <script>
        // Fungsi untuk melakukan enkripsi teks menggunakan metode Vigenere Cipher
        function vigenere_encrypt(plain_text, key) {
            const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            let encrypted_text = ''; // Variabel untuk menyimpan teks terenkripsi
            let keyIndex = 0; // Variabel untuk melacak indeks kunci saat ini

            for (let i = 0; i < plain_text.length; i++) {
                const plainChar = plain_text.charAt(i); // Ambil karakter teks asli pada posisi i
                if (plainChar === ' ') {
                    // Jika karakter adalah spasi, tambahkan spasi pada teks terenkripsi
                    encrypted_text += ' ';
                    continue;
                }

                const keyChar = key.charAt(keyIndex % key.length).toUpperCase(); // Ambil karakter kunci pada posisi keyIndex
                const shift = alphabet.indexOf(keyChar); // Hitung pergeseran berdasarkan huruf kunci

                if (alphabet.includes(plainChar.toUpperCase())) {
                    const isUpperCase = plainChar === plainChar.toUpperCase();
                    const index = alphabet.indexOf(plainChar.toUpperCase()); // Temukan indeks karakter asli dalam alfabet

                    let encryptedIndex = (index + shift) % 26; // Hitung indeks karakter terenkripsi
                    if (encryptedIndex < 0) {
                        encryptedIndex += 26; // Pastikan hasil modulo selalu positif
                    }

                    let encryptedChar = alphabet.charAt(encryptedIndex); // Ambil karakter terenkripsi

                    if (!isUpperCase) {
                        // Jika karakter asli adalah huruf kecil, ubah huruf terenkripsi ke huruf kecil
                        encryptedChar = encryptedChar.toLowerCase();
                    }

                    encrypted_text += encryptedChar; // Tambahkan karakter terenkripsi ke teks terenkripsi
                } else {
                    // Jika karakter bukan huruf alfabet, biarkan seperti itu dalam teks terenkripsi
                    encrypted_text += plainChar;
                }

                keyIndex++; // Pindahkan ke karakter kunci berikutnya
            }

            return encrypted_text; // Kembalikan teks terenkripsi
        }


        // Fungsi untuk mengeksekusi enkripsi teks ketika tombol "Encrypt" ditekan
        function encryptText() {
            const plaintext = document.getElementById("plaintext").value;
            const key = document.getElementById("key").value.toUpperCase();
            const encrypted_text = vigenere_encrypt(plaintext, key);
            // Tampilkan hasil enkripsi pada elemen dengan id "result"
            document.getElementById("result").textContent = `Encrypted Text: ${encrypted_text}`;
        }

        // Tambahkan fungsi dekripsi jika diperlukan.
    </script>

<script>
    // Fungsi untuk melakukan dekripsi teks yang dienkripsi dengan metode Vigenere Cipher
    function vigenere_decrypt(cipher_text, key) {
        const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        let decrypted_text = ''; // Variabel untuk menyimpan teks terdekripsi
        let keyIndex = 0; // Variabel untuk melacak indeks kunci saat ini

        for (let i = 0; i < cipher_text.length; i++) {
            const cipherChar = cipher_text.charAt(i); // Ambil karakter dari teks terenkripsi pada posisi i
            if (cipherChar === ' ') {
                // Jika karakter adalah spasi, tambahkan spasi pada teks terdekripsi
                decrypted_text += ' ';
                continue;
            }

            const keyChar = key.charAt(keyIndex % key.length).toUpperCase(); // Ambil karakter kunci pada posisi keyIndex
            const shift = alphabet.indexOf(keyChar); // Hitung pergeseran berdasarkan huruf kunci

            if (alphabet.includes(cipherChar.toUpperCase())) {
                const isUpperCase = cipherChar === cipherChar.toUpperCase();
                const index = alphabet.indexOf(cipherChar.toUpperCase()); // Temukan indeks karakter terenkripsi dalam alfabet

                let decryptedIndex = (index - shift) % 26; // Hitung indeks karakter asli
                if (decryptedIndex < 0) {
                    decryptedIndex += 26; // Pastikan hasil modulo selalu positif
                }

                let decryptedChar = alphabet.charAt(decryptedIndex); // Ambil karakter asli

                if (!isUpperCase) {
                    // Jika karakter terenkripsi adalah huruf kecil, ubah karakter asli ke huruf kecil
                    decryptedChar = decryptedChar.toLowerCase();
                }

                decrypted_text += decryptedChar; // Tambahkan karakter asli ke teks terdekripsi
            } else {
                // Jika karakter bukan huruf alfabet, biarkan seperti itu dalam teks terdekripsi
                decrypted_text += cipherChar;
            }

            keyIndex++; // Pindahkan ke karakter kunci berikutnya
        }

        return decrypted_text; // Kembalikan teks terdekripsi
    }


    // Fungsi untuk mengeksekusi dekripsi teks ketika tombol "Decrypt" ditekan
    function decryptText() {
        const ciphertext = document.getElementById("plaintext").value;
        const key = document.getElementById("key").value.toUpperCase();
        const decrypted_text = vigenere_decrypt(ciphertext, key);
        // Tampilkan hasil dekripsi pada elemen dengan id "result"
        document.getElementById("result").textContent = `Decrypted Text: ${decrypted_text}`;
    }
</script>

</body>
</html>