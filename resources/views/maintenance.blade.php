<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Under Maintenance | {{ config('app.name') }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      height: 100vh;
      background: linear-gradient(135deg, #141E30, #243B55);
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
      color: #fff;
      overflow: hidden;
    }

    .container {
      text-align: center;
      max-width: 600px;
      padding: 40px;
    }

    .animation-box {
      width: 220px;
      height: 220px;
      margin: 0 auto 30px;
      position: relative;
    }

    .gear {
      position: absolute;
      width: 100px;
      height: 100px;
      border: 6px solid #FFD166;
      border-radius: 50%;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      animation: rotate 6s linear infinite;
    }

    .gear::before,
    .gear::after {
      content: "";
      position: absolute;
      width: 12px;
      height: 25px;
      background: #FFD166;
      border-radius: 3px;
    }

    .gear::before {
      top: -15px;
      left: 50%;
      transform: translateX(-50%);
    }

    .gear::after {
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
    }

    .gear.small {
      width: 60px;
      height: 60px;
      border-color: #F4A261;
      top: 30%;
      left: 65%;
      animation: rotate-rev 4s linear infinite;
    }

    @keyframes rotate {
      0% { transform: translate(-50%, -50%) rotate(0deg); }
      100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    @keyframes rotate-rev {
      0% { transform: translate(-50%, -50%) rotate(360deg); }
      100% { transform: translate(-50%, -50%) rotate(0deg); }
    }

    h1 {
      font-size: 36px;
      margin-bottom: 10px;
      font-weight: 700;
      letter-spacing: 1px;
    }

    p {
      font-size: 16px;
      opacity: 0.9;
      margin-bottom: 25px;
    }

    .progress-bar {
      width: 100%;
      height: 8px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 5px;
      overflow: hidden;
      margin-bottom: 30px;
    }

    .progress {
      height: 100%;
      background: #FFD166;
      width: 50%;
      animation: loading 2s ease-in-out infinite alternate;
    }

    @keyframes loading {
      0% { width: 30%; }
      100% { width: 90%; }
    }

    a.button {
      display: inline-block;
      background: #FFD166;
      color: #000;
      padding: 12px 25px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s;
    }

    a.button:hover {
      background: #F4A261;
      transform: translateY(-3px);
    }

    footer {
      margin-top: 25px;
      font-size: 13px;
      opacity: 0.7;
    }

    @media (max-width: 768px) {
      .animation-box { width: 180px; height: 180px; }
      h1 { font-size: 28px; }
      p { font-size: 15px; }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="animation-box">
      <div class="gear"></div>
      <div class="gear small"></div>
    </div>

    <h1>We’ll Be Back Soon!</h1>
    <p>{{ $text ?? 'Our site is currently undergoing maintenance. We’re working hard to improve your experience!' }}</p>

    <div class="progress-bar"><div class="progress"></div></div>

    <a href="{{ url('/') }}" class="button">Go to Homepage</a>

    <footer>© {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.</footer>
  </div>

</body>
</html>
