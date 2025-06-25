<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMP IT Asy-Syadzili Information System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(45deg, #f39c12, #3498db, #2ecc71, #e74c3c);
      background-size: 400% 400%;
      animation: gradientAnimation 12s ease infinite;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    @keyframes gradientAnimation {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .login-card {
      background: rgba(255, 255, 255, 0.9);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      max-width: 400px;
      width: 100%;
    }

    .login-card img {
      max-width: 80px;
      margin-bottom: 20px;
    }

    .form-control:focus {
      box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
      border-color: #3498db;
    }

    .btn-primary {
      background-color: #3498db;
      border-color: #3498db;
    }

    .btn-primary:hover {
      background-color: #2980b9;
      border-color: #2980b9;
    }
  </style>
</head>
<body>

  <div class="login-card text-center">
    <!-- Logo -->
    <img src="<?= base_url('inc/system/logo.png');?>" alt="Logo SMP IT Asy-Syadzili">

    <!-- Title -->
    <h1 class="h5 mb-3">SMP IT Asy-Syadzili Information System</h1>
    <p class="text-muted">Silakan login untuk melanjutkan</p>

    <!-- Info Message -->
    <div id="infoMessage" class="text-danger mb-3"><?php echo $message; ?></div>

    <!-- Login Form -->
    <?php echo form_open("auth/login"); ?>

    <div class="mb-3 text-start">
      <label for="identity" class="form-label"><?php echo lang('login_identity_label'); ?></label>
      <?php echo form_input($identity, '', 'class="form-control" id="identity" placeholder="Masukkan email atau username"'); ?>
    </div>

    <div class="mb-3 text-start">
      <label for="password" class="form-label"><?php echo lang('login_password_label'); ?></label>
      <?php echo form_input($password, '', 'class="form-control" id="password" placeholder="Masukkan password"'); ?>
    </div>

    <div class="d-grid">
      <?php echo form_submit('submit', lang('login_submit_btn'), 'class="btn btn-primary"'); ?>
    </div>

    <?php echo form_close(); ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
