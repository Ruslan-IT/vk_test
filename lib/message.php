<div class="mess">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success" role="alert"><?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?></div>
    <?php endif; ?>
</div>
