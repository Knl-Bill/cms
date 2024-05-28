<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Scanner</title>
    <style>
        .viewport {
            width: 100%;
            height: 400px;
            border: 1px solid #ccc;
            margin-top: 20px;
            position: relative;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
        #ScannerMessage {
            margin-top: 20px;
            font-weight: bold;
        }
        #video {
            width: 100%;
            height: 100%;
        }
        #Interactive canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Scan Student ID Card</h1>
        <select id="cameraSelect"></select>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <div id="Interactive" class="viewport">
            <video id="video" autoplay></video>
        </div>
        <div id="ScannerMessage"></div>
        <form id="scannerForm" method="POST" action="/InsertOuting">
            @csrf
            <input style="display: none;" type="text" name="rollno" id="rollnoInput">
            <label for="gate">Gate: - </label>
            <select name="gate" id="gate">
                <option value="Main">Main</option>
                <option value="Poovam">Poovam</option>
            </select>
            <br>
            <button type="submit" id="submit">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.18.6/umd/index.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const codeReader = new ZXing.BrowserBarcodeReader();
            const videoElement = document.getElementById('video');
            const scannerMessage = document.getElementById('ScannerMessage');
            const scannerForm = document.getElementById('scannerForm');
            const rollnoInput = document.getElementById('rollnoInput');
            const cameraSelect = document.getElementById('cameraSelect');
            let formSubmitted = false;

            try {
                const devices = await codeReader.getVideoInputDevices();
                if (devices.length > 0) {
                    devices.forEach((device, index) => {
                        const option = document.createElement('option');
                        option.value = index;
                        option.text = device.label || `Camera ${index + 1}`;
                        cameraSelect.appendChild(option);
                    });

                    // Set default selection to the first camera
                    cameraSelect.value = 0;
                    cameraSelect.dispatchEvent(new Event('change'));

                    cameraSelect.addEventListener('change', async (event) => {
                        const selectedDeviceId = devices[event.target.value].deviceId;
                        await codeReader.reset();
                        codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
                            if (!formSubmitted && result) {
                                console.log('Barcode detected: ', result.text);
                                if (result.text.length === 9) { // assuming the roll no is 9 characters long
                                    const detectedRollNo = result.text;
                                    scannerMessage.innerText = 'Detected Roll No: ' + detectedRollNo;
                                    rollnoInput.value = detectedRollNo;
                                    return;
                                } else {
                                    scannerMessage.innerText = 'Invalid barcode detected. Please try again.';
                                }
                            }
                            if (err && !(err instanceof ZXing.NotFoundException)) {
                                console.error(err);
                                scannerMessage.innerText = 'Error: ' + err.message;
                            }
                        });
                    });
                } else {
                    scannerMessage.innerText = 'No video input devices found.';
                }
            } catch (error) {
                console.error('Error accessing video input devices:', error);
                scannerMessage.innerText = 'Error accessing video input devices: ' + error.message;
            }
        });
    </script>
</body>
</html>
