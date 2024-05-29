<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Scanner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/SecurityOuting.css">
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
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid custom-navbar">
          <img class="logo" src="assets/images/logo.webp" alt="logo">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav custom-nav-items">
              <li class="nav-item">
                <a class="nav-link home-btn" href='{{route('SecurityDashboard')}}'><i class="bi bi-house-door-fill custom-icon"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link profile-btn" href='{{route('SecurityProfile')}}'><i class="bi bi-person-fill custom-icon"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link logout-btn" id="logout">Logout</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <div class="outing-container">
        <h1 class="heading font">Scan Student ID Card</h1>
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
        <div class="inputs" id="Interactive" class="viewport">
            <video id="video" autoplay></video>
        </div>
        <div id="ScannerMessage"></div>
        <form id="scannerForm" method="POST" action="/InsertScannerLeave">
            @csrf
            <div class="form-group">
                <input class="inputs" style="display: none;" type="text" name="rollno" id="rollnoInput">
            </div>
            <div class="form-group">
                <label class="labels" for="gate">Gate: - </label>
                <select class="inputs" name="gate" id="gate">
                    <option value="Main">Main</option>
                    <option value="Poovam">Poovam</option>
                </select>
            </div>
            <div class="form-group button">
                <button class="submit-btn" type="submit" id="submit">Submit</button>
            </div>
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
                                if (result.text.length === 18) { // assuming the roll no is 9 characters long
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
